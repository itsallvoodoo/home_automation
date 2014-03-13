#!/usr/bin/env python2.7

# name:     truckinterface.py
# author:   Chad Hobbs
# created:  140309
#
# description: This is a custom python interface for my truck OBD2 bus



# ------------- setup ----------------
import serial
ser = serial.Serial('/dev/ttyUSB0', 115200, timeout=1)