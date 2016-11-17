# gee-web-mail
A web mail interface with C++ back end. High encrypted message exchange.

Please see the desktop version:
https://github.com/kkatayama/Gee-Mail

# Linux Compile
g++ -std=c++11 -I/usr/include/cryptopp \*.cpp cryptogm/\*.cpp GeeMail/\*.cpp GraphicEngine/\*.cpp -lcryptopp -lsqlite3 -o gee-mail-ws

# Notes
gee-mail-ws is the driver between crypto libraries and DB libraries which are used by our destop version.
Web mail uses php front end and uses c++ libraries on back end. Using exec is not an efficent way to do this but, it is functional for proof of concept.

