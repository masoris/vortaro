while (my $line = <stdin>) {
   $line =~ s/\r?\n//g;
   my ($k, $v) = split(/   /, $line, 2);
   if (defined $k && defined $v) {
       $k =~ s/ *$//g;
       $v =~ s/^ *//g;
       print "$k\t$v\n";
   }
}
