#!/usr/bin/perl -w

use LWP;

use Sys::Hostname;
use Socket;
use warnings;

my $status = $ARGV[0];
my $compName = hostname;

$ua = LWP::UserAgent->new;
#timeout in 60 seconds if we can't make a connection
$ua->timeout(60);

#send the HTTP request with the status of 1 and computer name
$request = $ua->post('http://209.140.207.237/statuschange.php',
                ["status" => -1,
                "workstation" => $compName]);

#if successful log 200 status else quit and log error
if ($request->is_success) {
    $content = $request->content;
    # print "Content-type: text/html\\n\\n";
    print $content;
} else {
    die "Can't get to URL", $request->status_line;
}
