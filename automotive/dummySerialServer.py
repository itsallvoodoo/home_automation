#!/usr/bin/env python2.7

# name:     dummySerialServer.py
# author:   Chad Hobbs
# created:  140321
#
# description: Used for testing of the truck interface program

import serial

ser = serial.Serial('/dev/ttyp3', 115200, timeout=1)

def readLog():
	with open('colorado-random', 'r') as f:
  		lineArr=f.read().split('\n')
  			





# ----------------------------------------------------------------------------------------
# Function Name: main()
# Parameters:    None
# Returns:       None
# Description:   Utilizing the serial library, writing and reading from the serial port
# ----------------------------------------------------------------------------------------
if __name__ == '__main__':
	
	while True:
		toOBDII = input('>')
		ser.write(toOBDII + ' \r')

		print ser.readline()