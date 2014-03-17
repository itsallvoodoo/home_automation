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
		self.ser.write(codes[code])
		return self.ser.readline().split(' ') 


	# ----------------------------------------------------------------------------------------
	# Function Name: print_speed()
	# Parameters:    self, code
	# Returns:       None
	# Description:   This prints the given speed of the vehicle
	# ----------------------------------------------------------------------------------------
	def print_speed(self,code):
		print "Speed is ",float(int('0x'+code[2], 0 )), " mph."









	
# ----------------------------------------------------------------------------------------
# Function Name: main()
# Parameters:    None
# Returns:       None
# Description:   This is the main method and controls the main program
# ----------------------------------------------------------------------------------------
if __name__ == '__main__':


	while True:
		thisCode = 0
		print_speed(get_speed(thisCode)),
		time.sleep(5)