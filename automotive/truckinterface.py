#!/usr/bin/env python2.7

# name:     truckinterface.py
# author:   Chad Hobbs
# created:  140309
#
# description: This is a custom python interface for my truck OBD2 bus



# ------------- LIBRARIES AND GLOBALS ----------------
import serial 	# This is the pyserial library, which enables communication via serial port
import time

ser = serial.Serial('/dev/ttyUSB0', 115200, timeout=1) #These are the parameters for my specific usb to serial adapter, (device,baud,timeout)




# ------------- INSTANTIATION ----------------

ser.write('ATSP0 \r'.rstrip())

codes = ["01 0C \r"]


# ----------------------------------------------------------------------------------------
# Function Name: get_data()
# Parameters:    code
# Returns:       None
# Description:   This retrieves data from the truck data bus
# ----------------------------------------------------------------------------------------
def get_data(code):
	ser.write(codes[code])
	time.sleep(1)
	speed_hex = ser.readline().split(' ')
	return float(int('0x'+speed_hex[2], 0 ))
	
# ----------------------------------------------------------------------------------------
# Function Name: main()
# Parameters:    None
# Returns:       None
# Description:   This is the main method and controls the main program
# ----------------------------------------------------------------------------------------
if __name__ == '__main__':


	while True:
		thisCode = 0
		print 'Speed: ', get_speed(thisCode), 'mph'
		time.sleep(5)