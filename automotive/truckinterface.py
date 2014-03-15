#!/usr/bin/env python2.7

# name:     truckinterface.py
# author:   Chad Hobbs
# created:  140309
#
# description: This is a custom python interface for my truck OBD2 bus

# ------------- LIBRARIES AND GLOBALS ----------------
import serial 	# This is the pyserial library, which enables communication via serial port
import time		# Library used to allow for delays


class truck:
	def __init__(self):
    	self.codes = ["01 0C \r"]

    	#Define the connection to the serial bus
    	self.ser = serial.Serial('/dev/ttyUSB0', 115200, timeout=1)

    	#Define the communication mode of the ELM327 USB to Serial cable
    	self.ser.write('ATSP0 \r')


    # ----------------------------------------------------------------------------------------
	# Function Name: get_data()
	# Parameters:    code - An integer specifying which code in a list of codes that is requested
	# Returns:       A float consisting of a hex value converted to integer
	# Description:   This retrieves data from the truck data bus
	# ----------------------------------------------------------------------------------------
	def get_data(self,code):
		ser.write(codes[code])
		speed_hex = ser.readline().split(' ')
		return float(int('0x'+speed_hex[2], 0 ))




# ----------------------------------------------------------------------------------------
# Function Name: get_data()
# Parameters:    code
# Returns:       None
# Description:   This retrieves data from the truck data bus
# ----------------------------------------------------------------------------------------




# ----------------------------------------------------------------------------------------
# Function Name: get_data()
# Parameters:    code
# Returns:       None
# Description:   This retrieves data from the truck data bus
# ----------------------------------------------------------------------------------------






	
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