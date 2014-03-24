#!/usr/bin/env python2.7

# name:     dummySerialServer.py
# author:   Chad Hobbs
# created:  140321
#
# description: Used for testing of the truck interface program

import serial

ser = serial.Serial('/dev/ttyp3', 115200, timeout=1)

# ----------------------------------------------------------------------------------------
# Function Name: readLog()
# Parameters:    None
# Returns:       An array of lines that were pulled from a log file
# Description:   This is called to read in a new log file and put it into an array
# ----------------------------------------------------------------------------------------
def readLog():
	with open('colorado-random', 'r') as f:
		lineArray=f.read().split('\n') 
  	return lineArray

# ----------------------------------------------------------------------------------------
# Function Name: cycleArray()
# Parameters:    None
# Returns:       None
# Description:   This method continually prints the array
# ----------------------------------------------------------------------------------------
def cycleArray(thisArray):

	i = 0
	size = len(lineArray)

	while True:
		try:
			ser.write(thisArray[i])
			i += 1
			if i == size:
				i = 0
		except KeyboardInterrupt:
			return


# ----------------------------------------------------------------------------------------
# Function Name: main()
# Parameters:    None
# Returns:       None
# Description:   Utilizing the serial library, writing and reading from the serial port
# ----------------------------------------------------------------------------------------
if __name__ == '__main__':


	lineArray = readLog()
	cycleArray(lineArray)

	
		
		