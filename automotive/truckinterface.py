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


# This method returns the speed at which the vehicle is travelling
def get_speed():
	ser.write("01 0C \r")
	time.sleep(1)
	speed_hex = ser.readline().split(' ')
	speed = float(int('0x'+speed_hex[2], 0 ))
	print 'Speed: ', speed, 'mph'

if __name__ == '__main__':


	while True:
		get_speed()
		time.sleep(5)