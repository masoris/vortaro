while (my $line = <STDIN>) {
    my @row = split(/\t/, $line);
    print $row[0], "\n";
}
