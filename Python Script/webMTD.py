class BusTimes:

	url = 'http://developer.cumtd.com/api/v2.1/xml/GetDeparturesByStop?key=61da79a30827434387c61005c3aa82c4&count=8&stop_id='

	spring = 'SPFLDHVY'

	main = 'GWNMN'
	
	data = ' '

	

	def getFiles(self, location):

		import urllib

		if location == 'Springfield':

			file = urllib.urlopen(self.url + self.spring)

		if location == 'Main':

			file = urllib.urlopen(self.url + self.main)

		data = file.read(-1)

		file.close()

		return data

	

	def getSilverTime(self):

		import xml.etree.ElementTree as xml

		springroot = xml.fromstring(self.getFiles('Springfield'))

		springroot = springroot[2]

		southSilver = '-1'

		

		for child in springroot:

			if(child[0].get('route_id').find('SILVER') != -1):

				if(child.get('is_monitored') == 'true'):

					if(child[1].get('direction') == 'South' and child.get('expected_mins') != '0'):

						southSilver = child.get('expected_mins')

						break

		

		return int(southSilver)

		

	def getGoldTime(self):

		import xml.etree.ElementTree as xml

		springroot = xml.fromstring(self.getFiles('Springfield'))

		springroot = springroot[2]

		westGold = '-1'

		

		for child in springroot:

			if(child[0].get('route_id') == 'GOLD' or child[0].get('route_id') == 'GOLDHOPPER'):

				if(child.get('is_monitored') == 'true'):

					if(child[1].get('direction') == 'West' and child.get('expected_mins') != '0'):

						westGold = child.get('expected_mins')

						break

						

		return int(westGold)



	def getIlliniTime(self):

		import xml.etree.ElementTree as xml

		goodroot = xml.fromstring(self.getFiles('Main'))

		goodroot = goodroot[2]

		southIllini = '-1'

						

		for child in goodroot:

			if(child[0].get('route_id').find('ILLINI') != -1):

				if(child.get('is_monitored') == 'true'):

					if(child[1].get('direction') == 'South' and child.get('expected_mins') != '0'):

						southIllini = child.get('expected_mins')

						break

						

		return int(southIllini)





import time

MTD = BusTimes()



loop = 'true'



while(loop):

	f = open('/home/jasmsu/public_html/cumtd/python/time.txt', 'w')

	silverTime = MTD.getSilverTime()

	goldTime = MTD.getGoldTime()

	illiniTime = MTD.getIlliniTime()

	f.write(str(silverTime))

	f.write(" ")

	f.write(str(goldTime))

	f.write(" ")

	f.write(str(illiniTime))

	f.close()

	

	time.sleep(45)

