# 4x4 RBG Led array with controllers (daisy-chainable)

16 Osram MultiLEDs Controlled via I2C using 3 PCA9635PW drivers.

5-bit board address set via DIP-switch, 28 boards in a chain.

By switching the addressing scheme (current one from a project that needed smaller address-space) this could be increased to 31 boards in a chain (or 27 if you want to avoid two address-spaces that are "reserved", check the i2c_addresses_test.php for details)

4-layer board so you need proper Eagle license to view, sorry...

# BOM

  - 3 x [PCA9635PW](http://fi.rsdelivers.com/product/nxp/pca9635pw/led-driver-23-55v-pca9635pw/0510897.aspx)
  - 1 x [RS377-8734](http://fi.rsdelivers.com/product/rs/8way-standard-half-pitch-dil-switch-25ma/3778734.aspx)
  - 16 x [LRTBG6TG-TV](http://fi.rsdelivers.com/product/osram-opto-semiconductors/lrtbg6tg-tv-1vaw-36st7-69-20-r18-ib/multiled-red-true-green-blue/6973682.aspx)
  - 3 x 4-way right-angle pin header (SMD), something like this: http://www.sparkfun.com/products/9015
  - 8 x [CAY16 100Ohm resistor array](http://fi.rsdelivers.com/product/bourns/cay16-101j4lf/4-array-convex-0603-lf-resistor-100r/5225563.aspx)
  - 4 x [CAY16 150Ohm resistor array](http://fi.rsdelivers.com/product/bourns/cay16-151j4/cay16-convex-chip-resistor-array-150r/2419614.aspx) 
  - 1 x [CAY16 100kOhm resistor array](http://fi.rsdelivers.com/product/bourns/cay16-104j4lf/4-array-convex-0603-lf-resistor-100k/5225591.aspx) 

Estimated price (in expensive Finland) is ~30EUR each when making 20-30 pieces (highly depending on what making the multilayer PCBs actually would cost, no RFPs sent out yet), one could also switch to cheaper leds but the Osram ones are *very* good (and very bright). If making 4-layer boards in small amounts turns out to be horridly expensive it probably would be possible to make two 2-layer ones designed to stack like shield on Arduino (one with the leds, other with the controllers). Decent quality 2-layers boards can be gotten dirt cheap from iTead in china.
