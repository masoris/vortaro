while (my $line = <STDIN>) {
    my @row = split(/,/, $line);
    print $row[0], "\n";
}
