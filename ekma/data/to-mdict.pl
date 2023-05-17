while (my $line = <STDIN>) {
    $line =~ s/\r?\n//g;
    my ($k, $v) = split(/\t/, $line, 2);
    print "$k\n";
    print "$v\n";
    print "</>\n";
}
    
