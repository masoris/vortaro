#!/usr/bin/perl

MAIN:
{
    if (! @ARGV) {
        print "Usage: $0 join-hajpin-ma-sort.txt.ext join-hajpin-ma-sort.txt.ext.mdict\n";
        print "       $0 ma-hanes-utf8.txt.tab.all ma-hanes-utf8.txt.tab.all.mdict\n";
        exit(0);
    }

    local(*F);
    local(*F2);
    open(F, "$ARGV[0]");
    open(F2, "> $ARGV[1]");
    while (my $line = <F>) {
        $line =~ s/\r?\n//g;
        my ($key, $val) = split(/\t/, $line, 2);

        $key =~ s/Ĉ/Cx/g;
        $key =~ s/Ĝ/Gx/g;
        $key =~ s/Ĥ/Hx/g;
        $key =~ s/Ĵ/Jx/g;
        $key =~ s/Ŝ/Sx/g;
        $key =~ s/Ŭ/Ux/g;

        $key =~ s/ĉ/cx/g;
        $key =~ s/ĝ/gx/g;
        $key =~ s/ĥ/hx/g;
        $key =~ s/ĵ/jx/g;
        $key =~ s/ŝ/sx/g;
        $key =~ s/ŭ/ux/g;

        print F2 $key, "\r\n";
        print F2 $val, "\r\n";

        print F2 "</>\r\n";
    }
    close(F);
    close(F2);
}
