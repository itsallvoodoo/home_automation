// name:     HVAC_Controller.ino
// author:   Chad Hobbs
// created:  121012
// last edit:
//
// description: This program controls multiple temperature sensors via the 1-wire protocol, and turns off and on an HVAC system based on presets
// Surface mount 1 address: 103EB683000800F1
// Short lead address: 10 18 40 44 0 8 0 70
// Long lead address: 10 CE A6 82 2 8 0 3F



// -------------LIBRARIES---------------- THESE ARE REQUIRED TO BE IN YOUR SKETCHBOOK/LIBRARY FOLDER FOR COMPILING ----
#include <OneWire.h>              // Protocol to communicate with onewire bus devices
#include <DallasTemperature.h>    // Temperature sensor protocol
#include <Wire.h>                 // Protocol to communicate with I2C devices
#include <Adafruit_MCP23017.h>    // LCD protocol
#include <Adafruit_RGBLCDShield.h>// LCD + Button shield protocol

// --------------PARAMETERS---------------------
byte addrs[1][8] = {{16,206,166,130,2,8,0,63}}; // ,{16,24,64,68,0,8,0,112}
                                  // {16,24,64,68,0,8,0,112} Temp Sensor 1
                                  // {16,206,166,130,2,8,0,63} Temp Sensor 2
int busPin = 4;                   // Data bus for One Wire Comms
int numOfDevices = 1;             // How many sensors are in loop
int high = 80;                    // This is the default high temp setting
int low = 70;                     // This is the default low temp setting
long currentTemp = 0.0;             // Highest or lowest temp depending on mode
boolean mode = 1;                 // Heat or Cool
int serialSpeed = 9600;           // Default serial comm speed
String heat = "Heat";
String cool = "Cool";
String currentMode = heat;
int tempSetpoint = 75;            // Default temperature setpoint on a reboot
boolean val;                      // Variable for user input
long oldTemp = 0;
int timeout = 30                  // Backlight timeout variable

// -------------Library Interaction--------------
// Data wire is plugged into busPin on the Arduino
#define ONE_WIRE_BUS busPin

// Setup a oneWire instance to communicate with any OneWire devices (not just Maxim/Dallas temperature ICs)
OneWire oneWire(ONE_WIRE_BUS);

// Pass our oneWire reference to Dallas Temperature. 
DallasTemperature sensors(&oneWire);
//void wdt_reset(void);

// arrays to hold device address
DeviceAddress insideThermometer = { 0x10, 0x39, 0xe2, 0x82, 0x02, 0x08, 0x00, 0x3e };

// Create our LCD Shield instance
Adafruit_RGBLCDShield lcd = Adafruit_RGBLCDShield();
#define ON 0x7            // For single color LCD, set on to white
#define OFF 0x0           // For single color LCD, set off to black

// ----------------------------------------------------------------------------------------
// Function Name: setup()
// Parameters:    None
// Returns:       None
// Description:   This function executes housekeeping duties and staging for the loop() function; executed once
void setup(){

  pinMode(busPin,INPUT);  // Designate temperature bus pin data direction
  Serial.begin(serialSpeed);

  sensors.begin();        // Start up the library. IC Default is 9 bit. If you have troubles consider upping it 12. Ups the delay
  lcd.begin(16, 2);       // set up the LCD's number of columns and rows
  lcd.setBacklight(ON);   // Start off with backlight on until time-out

}

// ----------------------------------------------------------------------------------------
// Function Name: loop()
// Parameters:    None
// Returns:       None
// Description:   This is the main executing block of the program, calling all ancillary functions to operate the Arduino
void loop(){
  
  if (timeout == 0) {                   // Turn on backlight for 30 seconds, else turn it off
    lcd.setBacklight(OFF);
  }else {
    lcd.setBacklight(ON);
  }

  lcd.setCursor(0, 1);                  // Starting postion of character printing
  
  uint8_t buttons = lcd.readButtons();  // Constantly check to see if something has been put on the bus
  
  if (getTemp()) {                      // Constantly check to see if the temperature has changed, and update appropriately
    lcd.clear();
    lcd.print("Current Temp: ");
    lcd.print(currentTemp);
  }
  
  if (buttons) {
    lcd.setBacklight(ON)
    if (buttons & BUTTON_SELECT) {
      lcd.print("SELECT ");
      lcd.setBacklight(VIOLET);
    }
    buttonHandler();
  }
  
}

// ----------------------------------------------------------------------------------------
// Function Name: buttonHandler()
// Parameters:    None
// Returns:       Boolean, True if the temperature has changed, else False
// Description:   This function polls the temp sensors, retrieves the values, and then returns
boolean buttonHandler(){
  lcd.clear();
    
    // If the UP Button is pushed, increasing the setpoint
    if (buttons & BUTTON_UP) {
      high = high + 1;
      lcd.print("Setpoint: ");
      lcd.print(high);
    }
    
    // If the Down Button is pushed, decreasing the setpoint
    if (buttons & BUTTON_DOWN) {
      high = high - 1;
      lcd.print("Setpoint: ");
      lcd.print(high);
    }

    if (buttons & BUTTON_LEFT) {
      lcd.print("LEFT ");
      lcd.setBacklight(GREEN);
    }
    if (buttons & BUTTON_RIGHT) {
      lcd.print("RIGHT ");
      lcd.setBacklight(TEAL);
    }
    if (buttons & BUTTON_SELECT) {
      lcd.print("SELECT ");
      lcd.setBacklight(VIOLET);
    }

}

// ----------------------------------------------------------------------------------------
// Function Name: getTemp()
// Parameters:    None
// Returns:       Boolean, True if the temperature has changed, else False
// Description:   This function polls the temp sensors, retrieves the values, and then returns
boolean getTemp(){
  currentTemp = 0;
  long temp = 0;
  sensors.requestTemperatures(); // Send the command to the device to get temperatures
  
  // Go through devices and read the temperatures
  for(int x = 0; x < numOfDevices; x++){
    // ------------FOLLOWING LINES FOR TESTING ONLY
    //Serial.print("Sensor ");
    //Serial.print(x);
    //Serial.print(" reports: ");
    //Serial.println(sensors.getTempF(addrs[x]));
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

  

