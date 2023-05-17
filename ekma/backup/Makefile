all:
	@echo "Usage: make build"
	@echo "       make clean"

clean:
	rm *.exe

build:
	@make sercxu-debug.exe
	@make sercxu.exe

sercxu.exe: sercxu.cpp
	g++ -O2 -DNDEBUG sercxu.cpp -o $@

sercxu-debug.exe: sercxu.cpp
	g++ -g sercxu.cpp -o $@
