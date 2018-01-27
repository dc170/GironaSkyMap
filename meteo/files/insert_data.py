import sys

import Adafruit_DHT
import smbus
import time
import Adafruit_BMP.BMP085 as BMP085
from w1thermsensor import W1ThermSensor
import MySQLdb

bus = smbus.SMBus(1)

conn = MySQLdb.connect(host= "1.1.1.1",
                  user="USER",
                  passwd="******!",
                  db="*****")
                  
x = conn.cursor()

# HUMIDITY


def insertMesura(x,db):
	t = time.strftime('%Y-%m-%d %H:%M:%S')
	sensorid = 1
	lloc = "UDGEEKS"
	query = "insert into mesura (lloc, data, sensor) values ('%s','%s',%s)" % (lloc,t,sensorid)
	x.execute(query)
	db.commit()
	return x.lastrowid
	

	
def humitat(x,db,idmesura):
	time.strftime('%Y-%m-%d %H:%M:%S')
	humidity, temperature = Adafruit_DHT.read_retry(Adafruit_DHT.AM2302, 19)
	modelSensor = "AM2302"
	print humidity
	if humidity is not None and temperature is not None:
		print('Temp={0:0.1f}*  Humidity={1:0.1f}%'.format(temperature, humidity))
	else:
		print('Failed to get reading. Try again!')
		sys.exit(1)
	query = "insert into humitat (modelSensor, mesura, humitat) values ('%s',%s,%s)" % (modelSensor,idmesura,humidity)
	x.execute(query)
	db.commit()
	return humidity




# LUX (LIGHT)

def llum(x,db,idmesura):
	# TSL2561 address, 0x39(57)
	# Select control register, 0x00(00) with command register, 0x80(128)
	#		0x03(03)	Power ON mode
	bus.write_byte_data(0x39, 0x00 | 0x80, 0x03)
	# TSL2561 address, 0x39(57)
	# Select timing register, 0x01(01) with command register, 0x80(128)
	#		0x02(02)	Nominal integration time = 402ms
	bus.write_byte_data(0x39, 0x01 | 0x80, 0x02)

	time.sleep(0.5)

	# Read data back from 0x0C(12) with command register, 0x80(128), 2 bytes
	# ch0 LSB, ch0 MSB
	data = bus.read_i2c_block_data(0x39, 0x0C | 0x80, 2)

	# Read data back from 0x0E(14) with command register, 0x80(128), 2 bytes
	# ch1 LSB, ch1 MSB
	data1 = bus.read_i2c_block_data(0x39, 0x0E | 0x80, 2)
	
	# Convert the data
	ch0 = data[1] * 256 + data[0]
	ch1 = data1[1] * 256 + data1[0]

	# Output data to screen
	print "Full Spectrum(IR + Visible) :%d lux" %ch0
	print "Infrared Value :%d lux" %ch1
	print "Visible Value :%d lux" %(ch0 - ch1)
	visible = ch0 - ch1
	modelSensor = "tsl2561"
	query = "insert into llum (spectre, infrared, visible,mesura, modelSensor) values (%s, %s, %s, %s, '%s')" % (ch0, ch1, visible, idmesura, modelSensor)
	x.execute(query)
	db.commit()

	


# PREASSURE

def presio(x,db,idmesura):
	preassure = BMP085.BMP085()

	print('Temp = {0:0.2f} *C'.format(preassure.read_temperature()))
	print('Pressure = {0:0.2f} Pa'.format(preassure.read_pressure()))
	print('Altitude = {0:0.2f} m'.format(preassure.read_altitude()))
	print('Sealevel Pressure = {0:0.2f} Pa'.format(preassure.read_sealevel_pressure()))
	pres = preassure.read_pressure()
	altitud = preassure.read_altitude()
	mar = preassure.read_sealevel_pressure()
	modelSensor = "BMP180"
	query = "insert into barometre (modelSensor, mesura, presio, altitud, nivellmar) values ('%s',%s,%s,%s,%s)" % (modelSensor, idmesura, pres, altitud, mar )
	x.execute(query)
	db.commit()
	


# TEMPERATURE

def temperatura(x,db,idmesura):
	modelSensor = "DS18B20"
	for sensor in W1ThermSensor.get_available_sensors():
		print("Sensor %s has temperature %.2f" % (sensor.id, sensor.get_temperature()))
		query = "insert into temperatura (modelSensor, mesura, temperatura) values ('%s',%s,%s)" % (modelSensor,idmesura, sensor.get_temperature())
		x.execute(query)
		db.commit()


while True:
	idmesura = insertMesura(x,conn)

	humitat(x,conn,idmesura)
	llum(x,conn,idmesura)
	presio(x,conn,idmesura)
	temperatura(x,conn,idmesura)
	
	time.sleep(15)
