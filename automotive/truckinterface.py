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
    	self.codes = ["01 01", "01 02", "01 03", "01 04", "01 05", "01 06", "01 07", "01 08", "01 09", "01 0A", "01 0B", "01 0C"]

    	#Define the connection to the serial bus
    	self.ser = serial.Serial('/dev/ttyUSB0', 115200, timeout=1)



    # ----------------------------------------------------------------------------------------
	# Function Name: base_state()
	# Parameters:    None
	# Returns:       True if all checks pass, otherwise it returns False
	# Description:   This puts the ELM327 into a base state in which the data is readable by the program
	# ----------------------------------------------------------------------------------------
    def base_state(self):


    	#Define the communication mode of the ELM327 USB to Serial cable
    	self.ser.write('ATSP0 \r')
    	time.sleep(2)
    	if self.ser.readline() == 'OK':
    		#Define the ... of the ELM327 USB to Serial cable
	    	self.ser.write('ATL1 \r')
	    	time.sleep(2)
	    	if self.ser.readline() == 'OK':
	    		#Define the ... of the ELM327 USB to Serial cable
	    		self.ser.write('ATH1 \r')
	    		time.sleep(2)
	    			if self.ser.readline() == 'OK':
	    				#Define the ... of the ELM327 USB to Serial cable
	    				self.ser.write('ATS1 \r')
	    				time.sleep(2)
	    				if self.ser.readline() == 'OK':
	    					#Define the ... of the ELM327 USB to Serial cable
	    					self.ser.write('ATAL \r')
	    					time.sleep(2)
	    					if self.ser.readline() == 'OK':
	    						return True
    	return False


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

	myTruck = truck
	if myTruck.base_state()
		print "Good to go"

		while True:
			try:
				
					thisCode = 11
					speed = myTruck.get_speed(thisCode + " \r")
					myTruck.print_speed(speed)
					time.sleep(5)
				
			except e:
				error = e
				print error