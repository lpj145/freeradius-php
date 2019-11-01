<?php
/**
 * This is under MIT license
 * Created to easily work on freeradius when you job at databases.
 * Supported databases: mysql, postrgres.
 * contact at marcos.adantas@hotmail.com
 * licensed under MIT
 */

namespace Freeradiusphp;

/**
 * Class RadiusUserMap
 * @package Freeradiusphp
 * # Attributes are supported by MikroTik RouterOS.

# Standard Attributes (defined in RFC 2865, 2866 and 2869)

ATTRIBUTE       User-Name                    1    string
ATTRIBUTE       User-Password                2    string  encrypt=1
ATTRIBUTE       Password                     2    string  encrypt=1
ATTRIBUTE       CHAP-Password                3    string
ATTRIBUTE       NAS-IP-Address               4    ipaddr
ATTRIBUTE       NAS-Port                     5    integer
ATTRIBUTE       Service-Type                 6    integer
ATTRIBUTE       Framed-Protocol              7    integer
ATTRIBUTE       Framed-IP-Address            8    ipaddr
ATTRIBUTE       Framed-IP-Netmask            9    ipaddr
ATTRIBUTE       Framed-Routing               10   integer
ATTRIBUTE       Filter-Id                    11   string
ATTRIBUTE       Framed-Mtu                   12   integer
ATTRIBUTE       Framed-Compression           13   integer
ATTRIBUTE       Login-Ip-Host                14   ipaddr
ATTRIBUTE       Login-Service                15   integer
ATTRIBUTE       Login-Port                   16   integer

ATTRIBUTE       Reply-Message                18   string
ATTRIBUTE       Login-Callback-Number        19   string
ATTRIBUTE       Framed-Callback-Id           20   string

ATTRIBUTE       Framed-Route                 22   string
ATTRIBUTE       Framed-Ipx-Network           23   integer
ATTRIBUTE       State                        24   string
ATTRIBUTE       Class                        25   string
ATTRIBUTE       Vendor-Specific              26   string
ATTRIBUTE       Session-Timeout              27   integer
ATTRIBUTE       Idle-Timeout                 28   integer
ATTRIBUTE       Termination-Action           29   integer
ATTRIBUTE       Called-Station-Id            30   string
ATTRIBUTE       Calling-Station-Id           31   string
ATTRIBUTE       NAS-Identifier               32   string
ATTRIBUTE       Proxy-State                  33   string
ATTRIBUTE       Login-Lat-Service            34   string
ATTRIBUTE       Login-Lat-Node               35   string
ATTRIBUTE       Login-Lat-Group              36   string
ATTRIBUTE       Framed-Appletalk-Link        37   integer
ATTRIBUTE       Framed-Appletalk-Network     38   integer
ATTRIBUTE       Framed-Appletalk-Zone        39   string
ATTRIBUTE       Acct-Status-Type             40   integer
ATTRIBUTE       Acct-Delay-Time              41   integer
ATTRIBUTE       Acct-Input-Octets            42   integer
ATTRIBUTE       Acct-Output-Octets           43   integer
ATTRIBUTE       Acct-Session-Id              44   string
ATTRIBUTE       Acct-Authentic               45   integer
ATTRIBUTE       Acct-Session-Time            46   integer
ATTRIBUTE       Acct-Input-Packets           47   integer
ATTRIBUTE       Acct-Output-Packets          48   integer
ATTRIBUTE       Acct-Terminate-Cause         49   integer
ATTRIBUTE       Acct-Input-Gigawords         52   integer
ATTRIBUTE       Acct-Output-Gigawords        53   integer

ATTRIBUTE       Event-Timestamp              55   date

ATTRIBUTE       CHAP-Challenge               60   string
ATTRIBUTE       NAS-Port-Type                61   integer
ATTRIBUTE       Port-Limit                   62   integer

ATTRIBUTE       Eap-Packet                   79   raw
ATTRIBUTE       Message-Authenticator        80   raw

ATTRIBUTE       Acct-Interim-Interval        85   integer
ATTRIBUTE       NAS-Port-Id                  87   string
ATTRIBUTE       Framed-Pool                  88   string
ATTRIBUTE       Chargeable-User-Id           89   string

ATTRIBUTE       Nas-Ipv6-Address             95   addr6
ATTRIBUTE       Framed-Ipv6-Prefix           97   prefix6
ATTRIBUTE       Framed-Ipv6-Pool             100  string
ATTRIBUTE       Error-Cause                  101  integer

ATTRIBUTE       Delegate-Ipv6-Prefix         123  prefix6
ATTRIBUTE       Framed-Ipv6-Address          168  addr6
ATTRIBUTE       Dns-Server-Ipv6-Address      169  addr6
ATTRIBUTE       Delegate-Ipv6-Pool           171  string


# FreeRADIUS internal attributes (they can not be transmitted via the RADIUS
# protocol - they are used for internal purposes only)

ATTRIBUTE       Auth-Type                    1000 integer
ATTRIBUTE       Acct-Unique-Session-Id       1051 string
ATTRIBUTE       Client-IP-Address            1052 ipaddr
ATTRIBUTE       SQL-User-Name                1055 string
ATTRIBUTE       NT-Password                  1058 string

# Standard Values

VALUE           Service-Type                 Framed                         2

VALUE           Framed-Protocol              PPP                            1

VALUE           Acct-Status-Type             Start                          1
VALUE           Acct-Status-Type             Stop                           2
VALUE           Acct-Status-Type             Interim-Update                 3

VALUE           Acct-Authentic               RADIUS                         1
VALUE           Acct-Authentic               Local                          2

VALUE           NAS-Port-Type                Async                          0
VALUE           NAS-Port-Type                ISDN-Sync                      2
VALUE           NAS-Port-Type                Virtual                        5
VALUE           NAS-Port-Type                Ethernet                       15
VALUE           NAS-Port-Type                Cable                          17
VALUE           NAS-Port-Type                Wireless-802.11                19

VALUE           Acct-Terminate-Cause         User-Request                   1
VALUE           Acct-Terminate-Cause         Lost-Carrier                   2
VALUE           Acct-Terminate-Cause         Lost-Service                   3
VALUE           Acct-Terminate-Cause         Idle-Timeout                   4
VALUE           Acct-Terminate-Cause         Session-Timeout                5
VALUE           Acct-Terminate-Cause         Admin-Reset                    6
VALUE           Acct-Terminate-Cause         Admin-Reboot                   7
VALUE           Acct-Terminate-Cause         Port-Error                     8
VALUE           Acct-Terminate-Cause         NAS-Error                      9
VALUE           Acct-Terminate-Cause         NAS-Request                    10
VALUE           Acct-Terminate-Cause         NAS-Reboot                     11
VALUE           Acct-Terminate-Cause         Port-Unneeded                  12
VALUE           Acct-Terminate-Cause         Port-Preempted                 13
VALUE           Acct-Terminate-Cause         Port-Suspended                 14
VALUE           Acct-Terminate-Cause         Service-Unavailable            15
VALUE           Acct-Terminate-Cause         Callback                       16
VALUE           Acct-Terminate-Cause         User-Error                     17
VALUE           Acct-Terminate-Cause         Host-Request                   18

VALUE           Auth-Type                    System                         1
 * @link https://wiki.mikrotik.com/wiki/Manual:RADIUS_Client/reference_dictionary
 */
class RadiusUserMap
{
    /**
     * Mikrotik attributes types
     * @var array
     */
    private $mikrotikAttributes = [];

    private $attributes = [
        'login' => 'User-Name',
        'password' => 'Cleartext-Password',
        'ppp' => ''
    ];

    /**
     * @var string
     */
    private $nasClientVendor;

    public function __construct(string $nasClientVendor)
    {
        $this->nasClientVendor = $nasClientVendor;
    }
}