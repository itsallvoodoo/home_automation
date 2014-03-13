#!/usr/bin/env python2.7

# name:     truckinterface.py
# author:   Chad Hobbs
# created:  140309
#
# description: This is a custom python interface for my truck OBD2 bus



# ------------- setup ----------------

import serial 	# This is the pyserial library, which enables communication via serial port


ser = serial.Serial('/dev/ttyUSB0', 115200, timeout=1) #These are the parameters for my specific usb to serial adapter, (device,baud,timeout)



# This method returns the speed at which the vehicle is travelling
def get_speed():
	ser.write("01 0D \r")
	speed_hex = ser.readline().split(' ')
	speed = float(int('0x'+speed_hex[3], 0 ))
	print 'Speed: ', speed, 'mph'

