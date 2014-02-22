#!/usr/bin/env python2.7

# name:     updateTemps.py
# author:   Chad Hobbs
# created:  140122
# last edit: 140217
#
# description: This script fetches the current temperature from a Dallas DS1820 Temperature Sensor attached to the Beaglebone
#	and inserts it into a databse on the same micro-controller

# -------------LIBRARIES----------------
import Adafruit_BBIO.GPIO as GPIO
import MySQLdb

# --------------GLOBALS-----------------
tempPin = "P8_XX" # Need to determine the actual pin being used on the BBB TODO


# ----------------------------------------------------------------------------------------
# Function Name: main()
# Parameters:    None
# Returns:       None
# Description:   This is the main method
# ----------------------------------------------------------------------------------------
if __name__ == '__main__':


	GPIO.setup(tempPin, GPIO.IN)
	