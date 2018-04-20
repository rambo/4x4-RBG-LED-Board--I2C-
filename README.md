View this project on [CADLAB.io](https://cadlab.io/node/903). 

# DEPRECATED

Actually this board was never manufactured, it was just a design excercise. Get a [TiM](http://www.seeedstudio.com/depot/tim-p-1516.html) (though I think the WS2811 driver has ponly 400Hz PWM frequency which might be too low for some people/applications, the PCA9635PW drivers on this board have 200kHz PWM frequency...)

# 4x4 RBG Led array with controllers (daisy-chainable)

16 Osram MultiLEDs Controlled via I2C using 3 PCA9635PW drivers.

5-bit board address set via DIP-switch, 28 boards in a chain.

By switching the addressing scheme (current one from a project that needed smaller address-space) this could be increased to 31 boards in a chain (or 27 if you want to avoid two address-spaces that are "reserved", check the i2c_addresses_test.php for details)

4-layer board so you need proper Eagle license to view, sorry...

This [Arduino library][pca9635RGB] should work for controlling (it's for a very similar board that has only the drivers)

[pca9635RGB]: https://github.com/rambo/pca9635RGB

## Pros and Cons

Aka, "why would I want something so expensive then I can get 8x8 array for ~10USD". The *big* difference is that the 8x8 array is a matrix
and you need a lot of i/o pins to actively drive it and even then you have to multiplex (and your refresh rate goes down with the number of leds you wish to keep lit a the same time), this board drives each led individually and uses high frequency PWM so the result is *much* better (also the leds are very high quality, unless you substitute), also: 2 I/O pins regardless of number of boards (in single bus).

### Cons

  - price
  - resolution (only 4x4 "pixels" on 43x43mm)

### Pros

  - I2C takes 2 I/O Pins (and depending on how many boards you use you might fit other devices to the same bus)
  - All active drivers in the board, you need to control them only when changing outputs
  - Scales to rather large number of leds (2x14 boards = 8x56leds) on a single bus (you will need to feed power in from multiple points in these chains)

# TODOs

  - (maybe) switch to the other addressing scheme for more boards per bus
  - add smd elcap to the board (there's plenty of space, this design is heavily based on another one where the leds got their power from elsewhere and that elsewhere has caps near the leds)

# BOM

  - 3 x [PCA9635PW](http://fi.rsdelivers.com/product/nxp/pca9635pw/led-driver-23-55v-pca9635pw/0510897.aspx)
  - 1 x [RS377-8734](http://fi.rsdelivers.com/product/rs/8way-standard-half-pitch-dil-switch-25ma/3778734.aspx)
  - 16 x [LRTBG6TG-TV](http://fi.rsdelivers.com/product/osram-opto-semiconductors/lrtbg6tg-tv-1vaw-36st7-69-20-r18-ib/multiled-red-true-green-blue/6973682.aspx)
  - 3 x 4-way right-angle pin header (SMD), something like this: http://www.sparkfun.com/products/9015
  - 8 x [CAY16 100Ohm resistor array](http://fi.rsdelivers.com/product/bourns/cay16-101j4lf/4-array-convex-0603-lf-resistor-100r/5225563.aspx)
  - 4 x [CAY16 150Ohm resistor array](http://fi.rsdelivers.com/product/bourns/cay16-151j4/cay16-convex-chip-resistor-array-150r/2419614.aspx) 
  - 1 x [CAY16 100kOhm resistor array](http://fi.rsdelivers.com/product/bourns/cay16-104j4lf/4-array-convex-0603-lf-resistor-100k/5225591.aspx) 

Estimated price (in expensive Finland) is ~30EUR each when making 20-30 pieces (highly depending on what making the multilayer PCBs actually would cost, no RFPs sent out yet), one could also switch to cheaper leds but the Osram ones are *very* good (and very bright). If making 4-layer boards in small amounts turns out to be horridly expensive it probably would be possible to make two 2-layer ones designed to stack like shield on Arduino (one with the leds, other with the controllers). Decent quality 2-layers boards can be gotten dirt cheap from iTead in china.
