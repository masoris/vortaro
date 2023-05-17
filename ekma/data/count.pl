#!/usr/bin/perl

MAIN:
{
    my $count = {};

    local(*F);
    if (open(F, "./tiru-enhavon.log")) {
        while (my $line = <F>) {
            # 2009/11/07-17:47:22 211.180.196.48 polus-o
            my @row = split(/ /, $line);
            my $date = substr($row[0], 0, 10);
            my $ip = $row[1];

            next if ($ip eq '221.132.71.222' || $ip eq '110.10.242.192');

            $count->{$date} = {} if (! defined $count->{$date});
            $count->{$date}->{$ip} = 0 if (! defined $count->{$date}->{$ip});
            $count->{$date}->{$ip} += 1;
        }
        close(F);
    } 

    foreach my $date (sort(keys %{$count})) {
        my $ips = scalar(keys %{$count->{$date}});
        my $num = 0;
        foreach my $ip (keys %{$count->{$date}}) {
            $num += $count->{$date}->{$ip};
        }

        printf("%s %5d %5d\n", $date, $ips, $num);
    }

}
