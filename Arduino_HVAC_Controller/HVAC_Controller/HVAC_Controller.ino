// name:     HVAC_Controller.ino
// author:   Chad Hobbs
// created:  121012
// last edit: 130118
//
// description: This program controls multiple temperature sensors via the 1-wire protocol, and turns off and on an HVAC system based on presets
// Surface mount 1 address: 103EB683000800F1
// Short lead address: 10 18 40 44 0 8 0 70
// Long lead address: 10 CE A6 82 2 8 0 3F



// -------------LIBRARIES---------------- THESE ARE REQUIRED TO BE IN YOUR SKETCHBOOK\LIBRARY FOLDER FOR COMPILING ----
#include <OneWire.h>              // Protocol to communicate with onewire bus devices
#include <DallasTemperature.h>    // Temperature sensor protocol
#include <Wire.h>                 // Protocol to communicate with I2C devices
#include <Adafruit_MCP23017.h>    // LCD protocol
#include <Adafruit_RGBLCDShield.h>// LCD + Button shield protocol

// --------------PARAMETERS---------------------
byte addrs[1][8] = {{16,206,166,130,2,8,0,63}};  // THIS IS PARTICULAR TO THE SPECIFIC DS1820 USED
                                  // {16,24,64,68,0,8,0,112} Temp Sensor 1
                                  // {16,206,166,130,2,8,0,63} Temp Sensor 2 unused at this time
int busPin = 4;                   // Data bus for One Wire Comms
int numOfDevices = 1;             // How many sensors are in loop
int heat = 70;                    // This is the default heater trigger temp setting
int cool = 80;                    // This is the default cooling trigger temp setting
int buffer = 2;                   // This is the range away from the setpoint the heat or AC will overcool/heat to prevent shorter cycles
int heatPin = 7;                  // Digital pin used for turning on the heater relay
int coolPin = 8;                  // Digital pin used for turning on the AC relay
int cycleTime = 600000;           // The length of time to delay running the AC or heat to prevent short cycling
boolean heatRunning = FALSE;      // Stores whether the heater is currently running or not
boolean coolRunning = FALSE;      // Stores whether the AC is currently running or not
long currentTemp = 0.0;           // Current room temperature
int serialSpeed = 9600;           // Default serial comm speed
long oldTemp = 0;                 // Used to only update the currentTemp if the temp has changed
unsigned long timeOut;            // Backlight timeout variable
boolean editable = FALSE;         // Determines whether or not button presses will do anything, used to avoid accidental changes
char* menu[] = {"Cooling", "Heating"};  // Menu display for either setting the high point or the low point of the temp range
int menuPosition = 1;             // Current position in the setting menu
unsigned long heatLastRan;        // Stores the time the heater last ran
unsigned long coolLastRan;        // Stores the time the AC last ran

// -------------Library Interaction--------------
// Data wire is plugged into busPin on the Arduino
#define ONE_WIRE_BUS busPin

// Setup a oneWire instance to communicate with any OneWire devices (not just Maxim/Dallas temperature ICs)
OneWire oneWire(ONE_WIRE_BUS);

// Pass our oneWire reference to Dallas Temperature. 
DallasTemperature sensors(&oneWire);
//void wdt_reset(void);

// arrays to hold device address
DeviceAddress insideThermometer = { 0x10, 0x39, 0xe2, 0x82, 0x02, 0x08, 0x00, 0x3e }; // THIS IS PARTICULAR TO THE SPECIFIC DS1820 USED

// Create our LCD Shield instance
Adafruit_RGBLCDShield lcd = Adafruit_RGBLCDShield();
#define ON 0x7            // For single color LCD, set on to white
#define OFF 0x0           // For single color LCD, set off to black

// ----------------------------------------------------------------------------------------
// Function Name: setup()
// Parameters:    None
// Returns:       None
// Description:   This function executes housekeeping duties and staging for the loop() function; executed once
// ----------------------------------------------------------------------------------------
void setup(){

  pinMode(busPin,INPUT);  // Designate temperature bus pin data direction
  pinMode(heatPin,OUTPUT);                // Heat circuit relay 
  pinMode(coolPin,OUTPUT);                // Cooling circuit relay
  Serial.begin(serialSpeed);

  sensors.begin();        // Start up the library. IC Default is 9 bit. If you have troubles consider upping it 12. Ups the delay
  lcd.begin(16, 2);       // set up the LCD's number of columns and rows
  lcd.setBacklight(ON);   // Start off with backlight on until time-out
  timeOut = millis();     // Set the initial backlight time

}

// ----------------------------------------------------------------------------------------
// Function Name: loop()
// Parameters:    None
// Returns:       None
// Description:   This is the main executing block of the program, calling all ancillary functions to operate the Arduino
// ----------------------------------------------------------------------------------------
void loop(){
  if ((millis() - timeOut) > 30000) {                   // Turn on backlight for 30 seconds, else turn it off
    lcd.setBacklight(OFF);
    editable == FALSE;
  }else {
    lcd.setBacklight(ON);
  }

  lcd.setCursor(0, 1);                  // Starting postion of character printing
  
  uint8_t buttons = lcd.readButtons();  // Constantly check to see if something has been put on the bus
  
  // --------------Handle updating Temp Change Display---------------------
  if (getTemp()) {                      // Constantly check to see if the temperature has changed, and update appropriately
    lcd.clear();
    lcd.print("Current Temp: ");
    lcd.print(currentTemp);
  }
  
  // --------------Handle Button Presses---------------------
  if (buttons) {
    timeOut = millis();
    lcd.setBacklight(ON);
    

    if (buttons & BUTTON_SELECT) {      // Allow parameters to be changed only if the Select button has been pressed first
      editable = TRUE;
    }
    if (editable) {                     // go to buttonHandler to handle menu switching and parameter manipulations
      buttonHandler(buttons);
    }
  }
  
  // --------------Handle Heat and Cooling Cycles---------------------
  powerControl();
  
}

// ----------------------------------------------------------------------------------------
// Function Name: powerControlHandler()
// Parameters:    None
// Returns:       None
// Description:   This function will handle turning AC or Heat off and on based on current temp, timers, and setpoints
// ----------------------------------------------------------------------------------------
void powerControl(){
  
  // TODO: Add in fan relay control


  // This executes if the heater is running and it gets warm enough to turn off.
  if (heatRunning && (currentTemp > (heat + buffer))) {
      heatRunning = FALSE;
      heatLastRan = millis();
      digitalWrite(heatPin,HIGH);
      return;
    }

  // This executes if the AC is running and it gets cool enough to turn off
  if (coolRunning && (currentTemp < (cool - buffer))) {
      coolRunning = FALSE;
      coolLastRan = millis();
      digitalWrite(coolPin,HIGH);
      return;
    }

  // This executes if it gets cold enough and the heater has not run for a minimum time (short cycle protection)
  if ((currentTemp < heat) && ((millis() - heatLastRan) > cycleTime)) {
    digitalWrite(heatPin,HIGH);
    heatRunning = TRUE;
    return;
  }

  // This executes if it gets hot enough and the AC has not run for 10 minutes (short cycle protection)
  if ((currentTemp > cool) && ((millis() - coolLastRan) > 600000)) {
    digitalWrite(coolPin,HIGH);
    coolRunning = TRUE;
    return;
  }

  return;
}


// ----------------------------------------------------------------------------------------
// Function Name: buttonHandler()
// Parameters:    None
// Returns:       Boolean, True if the temperature has changed, else False
// Description:   This function polls the temp sensors, retrieves the values, and then returns
// ----------------------------------------------------------------------------------------
boolean buttonHandler(uint8_t buttons){

  // --------------PARAMETERS---------------------
  int heatModifier = 0;
  int coolModifier = 0;
    

  // --------------SETUP---------------------
  lcd.clear();

  // If the UP Button is pushed, increasing the setpoint
  if (buttons & BUTTON_UP) {
    if (menuPosition == 0) {
      coolModifier = 1;
    }
    if (menuPosition == 1) {
      heatModifier = 1;
    }
  }
    
  // If the Down Button is pushed, decreasing the setpoint
  if (buttons & BUTTON_DOWN) {
    if (menuPosition == 0) {
      coolModifier = -1;
    }
    if (menuPosition == 1) {
      heatModifier = -1;
    }
  }

  // If the Left Button is pushed, change the menu context
  if (buttons & BUTTON_LEFT) {
    if (menuPosition == 1){
      menuPosition = 0;
    }else {
      menuPosition = 1;
    }
  }

  // If the Right Button is pushed, change the menu context
  if (buttons & BUTTON_RIGHT) {
    if (menuPosition == 1){
      menuPosition = 0;
    }else {
      menuPosition = 1;
    }
  }
  
  // If anything has been modified, update accordingly
  heat = heat + heatModifier;
  cool = cool + coolModifier;
  
  // Print proper menu title and setpoint
  lcd.setCursor(0, 0);
  lcd.print(menu[menuPosition]);
  lcd.setCursor(0, 1);
  lcd.print("Setpoint: ");

  if (menuPosition == 0) {
    lcd.print(cool);
  }
  if (menuPosition == 1) {
    lcd.print(heat);
  }

}

// ----------------------------------------------------------------------------------------
// Function Name: getTemp()
// Parameters:    None
// Returns:       Boolean, True if the temperature has changed, else False
// Description:   This function polls the temp sensors, retrieves the values, and then returns
// ----------------------------------------------------------------------------------------
boolean getTemp(){
  currentTemp = 0;
  long temp = 0;
  sensors.requestTemperatures(); // Send the command to the device to get temperatures
  
  // Go through devices and read the temperatures
  for(int x = 0; x < numOfDevices; x++){
    temp = sensors.getTempF(addrs[x]);
    if(temp != currentTemp){
      currentTemp = temp;
    }      
  }

  // Check to see if temperature has changed
  if (currentTemp != oldTemp) {
    oldTemp = currentTemp;
    return true;
  }
  else {
    return false;
  }
}

  

