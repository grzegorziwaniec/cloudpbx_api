# cloudpbx_api_client
> Sample client for CloudPBX API.


## General Information
- CloudPBX service is a cloud telephony platform with most advanced telco features and simple user interface. It offers virtual PBXes in VoIP technology for busines. 
More information can be found on https://www.cloudpbx.pl/en/.
This project provides sample code for CloudPBX API. Polish documentation for API: https://wiki.poziom7.pl/doku.php?id=cloudpbx:apps:cloudpbx_api

## Technologies Used
- The code was written in PHP v7.4
- API uses REST specification to send a specific command
- API uses WebSocket protocol for events handling

## Features
List the ready features here:
- An example usage of REST interface and metgods "cdr" and "record"
- An example usage of WebSocket and events handling


## Setup

- Download repository:
```
$ git clone https://github.com/grzegorziwaniec/cloudpbx_api_client.git
```
- Install dependiences:
```
$ composer install
```
- create a setup file with name .env
```
API_URL=[API_URL]
API_KEY=[API_KEY]
WS_URL=[WSS_URL]
PBX_NAME=[YourPBXName]
```
To obtain keys and urls please contact with CloudPBX support at support@cloudpbx.pl

## Usage

The 'public' directory includes two files with example usage of REST and WS API

The websocket.php contains an example of handling several events provided by API.
To start WS example just type 
```
 cd public/
 php ./websocket.php
```

The rest.php file shows how to use REST interface.
To start REST example just type 
```
 cd public/
 php ./rest.php
```
