#!/usr/bin/env python2.7

# name:     pythonSerialTesting.py
# author:   Chad Hobbs
# created:  140320
#
# description: Simple tester of the serial library

import serial

ser = serial.Serial('/dev/ptyp3', 115200, timeout=1)

# ----------------------------------------------------------------------------------------
# Function Name: main()
# Parameters:    None
# Returns:       None
# Description:   Utilizing the serial library, writing and reading from the serial port
# ----------------------------------------------------------------------------------------
if __name__ == '__main__':
	while True:
		#toOBDII = input('>')
		#ser.write(toOBDII + ' \r')

		print ser.readline()