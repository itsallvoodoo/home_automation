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


def digitalGpioExamples():

	# Set up pin P8_10 as an output
	GPIO.setup("P8_10", GPIO.OUT) # or GPIO.setup("GPIO0_26", GPIO.OUT) referring to the actual pin name instead of header_number
	GPIO.output("P8_10", GPIO.HIGH)
	GPIO.cleanup()

	# Set up pin P8_14 as an input
	GPIO.setup("P8_14", GPIO.IN)

	# Check to see if there is a signal or not and report on the status
	if GPIO.input("P8_14"):
    	print("HIGH")
    else:
    	print("LOW")

    # If you want edge detection instead, look no further (THIS IS BLOCKING, so be aware)
    GPIO.wait_for_edge("P8_14", GPIO.RISING)

    # Non blocking version
    GPIO.add_event_detect("P9_12", GPIO.FALLING)
    #your amazing code here
    #detect wherever:
    if GPIO.event_detected("P9_12"):
    	print "event detected!"

    