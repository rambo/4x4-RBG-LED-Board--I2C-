<?php
error_reporting(E_ALL);
/**
 * hard-reserved addresses
 */
$err = array
(
    '1110000', // All-call for the led-modules
    '1110001', // Subaddress all-call 1 (R-channel)
    '1110010', // Subaddress all-call 2 (G-channel)
    '1110100', // Subaddress all-call 3 (B-channel)
);
/**
 * Addresses that might interfere with something
 */
$warn = array
(
    '0000000', // Generall I2C all-call
    '0000011', // "reserved for future use"
    /**
     * Generated below
     *
    '11111XX', // "reserved for future use"
    '11110XX', // "slave devices that use the 10-bit addressing scheme"
    '00001XX', // "Hs-mode"
    */
);
for ($i=0; $i<=3; $i++)
{
    $warn[] = '11111' . str_pad(decbin($i), 2, '0', STR_PAD_LEFT);
    $warn[] = '11110' . str_pad(decbin($i), 2, '0', STR_PAD_LEFT);
    $warn[] = '00001' . str_pad(decbin($i), 2, '0', STR_PAD_LEFT);
}
sort($warn);

/**
 * Generate addresses using the following scheme: XX0Y YYY
 * XX = (10=R, 01=G, 11=B)
 * YYYY = Binary Coded Decimal (using BCH will yield us a bunch more addresses
 */
echo "Scheme XXYYYYY where: XX = (10=R, 01=G, 11=B) YYYYY = Board address\n";
$usable_single = 0;
$usable_boards = 0;
// BCH
//for ($i2=0; $i2<=15; $i2++)
// BCD
//for ($i2=0; $i2<=9; $i2++)
// 5-bit DIP
for ($i2=0; $i2<=31; $i2++)
{
    // RGB
    $board_is_usable = true;
    for ($i=1; $i<=3; $i++)
    {
        ++$usable_single;
        $addr = str_pad(decbin($i), 2, '0', STR_PAD_LEFT) . str_pad(decbin($i2), 5, '0', STR_PAD_LEFT);
        echo $addr . ' (0x' . str_pad(dechex(bindec($addr)), 2, '0', STR_PAD_LEFT) . ') i2=' . $i2 . ' i=' . $i;
        echo "\tR={$addr}0 (0x" . str_pad(dechex(bindec($addr)), 2, '0', STR_PAD_LEFT) . ") W={$addr}1 (0x" . str_pad(dechex(bindec($addr)), 2, '0', STR_PAD_LEFT) . ")";
        if (in_array($addr, $err))
        {
            --$usable_single;
            echo ' ERRROR';
            $board_is_usable = false;
        }
        if (in_array($addr, $warn))
        {
            echo ' WARNING';
        }
        echo "\n";
    }
    if ($board_is_usable)
    {
        ++$usable_boards;
    }
    echo "\n";
}
echo "usable_single: {$usable_single}, usable_boards:{$usable_boards}\n";

/**
 * Generate addresses using the following scheme: YYYY0XX
 * XX = (10=R, 01=G, 11=B)
 * YYYY = Binary Coded Decimal (using BCH will yield us a bunch more addresses
 */
echo "\n\nScheme YYYYYXX\n";
$usable_single = 0;
$usable_boards = 0;
// BCH
//for ($i2=0; $i2<=15; $i2++)
// 5-bit DIP
for ($i2=0; $i2<=31; $i2++)
{
    // RGB
    $board_is_usable = true;
    for ($i=1; $i<=3; $i++)
    {
        ++$usable_single;
        $addr = strrev(str_pad(decbin($i2), 5, '0', STR_PAD_LEFT)) . strrev(str_pad(decbin($i), 2, '0', STR_PAD_LEFT));
        echo $addr . ' (0x' . str_pad(dechex(bindec($addr)), 2, '0', STR_PAD_LEFT) . ') i2=' . $i2 . ' i=' . $i;
        echo "\tR={$addr}0 (0x" . str_pad(dechex(bindec($addr)), 2, '0', STR_PAD_LEFT) . ") W={$addr}1 (0x" . str_pad(dechex(bindec($addr)), 2, '0', STR_PAD_LEFT) . ")";
        if (in_array($addr, $err))
        {
            --$usable_single;
            echo ' ERRROR';
            $board_is_usable = false;
        }
        if (in_array($addr, $warn))
        {
            echo ' WARNING';
        }
        echo "\n";
    }
    if ($board_is_usable)
    {
        ++$usable_boards;
    }
    echo "\n";
}
echo "usable_single: {$usable_single}, usable_boards:{$usable_boards}\n";


?>