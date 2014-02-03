def fetch():
	w1="/sys/bus/w1/devices/10-000800444018/w1_slave"
	raw = open(w1, "r").read()
	return int(raw.split("t=")[-1])

if __name__ == '__main__':
	fetch()
