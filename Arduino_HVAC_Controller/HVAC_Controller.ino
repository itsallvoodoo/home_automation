// name:     HVAC_Controller.ino
// author:   Chad Hobbs
// created:  121012
// last edit:
//
// description: This program controls multiple temperature sensors via the 1-wire protocol, and turns off and on an HVAC system based on presets
// Surface mount 1 address: 103EB683000800F1
// Short lead address: 10 18 40 44 0 8 0 70
// Long lead address: 10 CE A6 82 2 8 0 3F



// -------------LIBRARIES----------------
#include <OneWire.h>
#include <DallasTemperature.h>

// --------------PARAMETERS---------------------
byte addrs[2][8] = {{16,24,64,68,0,8,0,112},{16,206,166,130,2,8,0,63}};
                                  // {16,24,64,68,0,8,0,112} Temp Sensor 1
                                  // {16,206,166,130,2,8,0,63} Temp Sensor 2
int busPin = 2;                   // Data bus for One Wire Comms
int upPin = 3;                    // Pin used to increase set temp
int downPin = 4;                  // Pin used to decrease set temp
int numOfDevices = 2;             // How many sensors are in loop
int high = 80;                    // This is the default high temp setting
int low = 70;                     // This is the default low temp setting
long currentTemp = 0.0;             // Highest or lowest temp depending on mode
boolean mode = 1;                 // Heat or Cool
int serialSpeed = 9600;           // Default serial comm speed
String heat = "Heat";
String cool = "Cool";
String currentMode = heat;
int tempSetpoint = 75;            // Default temperature setpoint on a reboot
boolean val;                // Variable for user input
long oldTemp = 0;

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



// --------------SETUP-----------------------
void setup(){

  pinMode(busPin,INPUT);
  pinMode(upPin,INPUT);
  pinMode(downPin,INPUT);
  Serial.begin(serialSpeed);

  // Start up the library
  sensors.begin(); // IC Default 9 bit. If you have troubles consider upping it 12. Ups the delay

}

// --------------------MAIN------------------
void loop(){
  //Serial.println("Getting Temperature Data...");
  //delay(100);
  if (getTemp() == true) {
    Serial.print("Current Temperature is: ");
    Serial.println(currentTemp);
  }
  
  if (getSetPoint() == true) {
    Serial.print("Current setpoint is: ");
    Serial.println(tempSetpoint);
  }
  
}

boolean getTemp(){
  currentTemp = 0;
  long temp = 0;
  sensors.requestTemperatures(); // Send the command to get temperatures
  
  for(int x = 0; x < numOfDevices; x++){
    // ------------FOLLOWING LINES FOR TESTING ONLY
    //Serial.print("Sensor ");
    //Serial.print(x);
    //Serial.print(" reports: ");
    //Serial.println(sensors.getTempF(addrs[x]));
    temp = sensors.getTempF(addrs[x]);
    if(temp > currentTemp){
      currentTemp = temp;
    }      
  }
  if (currentTemp != oldTemp) {
    oldTemp = currentTemp;
    return true;
  }
  else {
    return false;
  }
}

boolean getSetPoint(){
  val = digitalRead(upPin);
  if (val == LOW) {
    while (val == LOW) {
      val = digitalRead(upPin);
    }
    tempSetpoint = tempSetpoint + 1;
    return true;
  }
  val = digitalRead(downPin);
  if (val == LOW) {
    while (val == LOW) {
      val = digitalRead(downPin);
    }
    tempSetpoint = tempSetpoint - 1;
    return true;
  }
  return false;
}
  

