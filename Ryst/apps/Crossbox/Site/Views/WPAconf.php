ctrl_interface=DIR=/var/run/wpa_supplicant GROUP=netdev
update_config=1

network={
	ssid="pi"
	key_mgmt=NONE
	auth_alg=OPEN
	scan_ssid=1
}

network={
	ssid="ryst"
	psk="ryst37"
	key_mgmt=WPA-PSK
	scan_ssid=1
}