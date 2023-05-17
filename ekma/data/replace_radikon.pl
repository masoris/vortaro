while (my $line = <STDIN>) {
    $line =~ s/\r?\n//g;
    my ($head, $tail) = split(/\t/, $line);

    my $radiko = $head;
    $radiko =~ s/^\-//;
    $radiko =~ s/^\?//;
    $radiko =~ s/\.$//;
    $radiko =~ s/\?$//;
    $radiko =~ s/\-$//;
    $radiko =~ s/\-[iao]$//;

    while (1) {
        if ($tail =~ / ([a-zA-z])(~)/) {
            my ($prefix, $c1, $c2, $postfix) = ($`, $1, $2, $');

            my $C0 = lc(substr($radiko, 0, 1));
            my $C1 = lc($c1);

            if ($C0 eq $C1) {
                $tail = $prefix . $c1 . substr($radiko, 1) . $postfix;
            } else {
                $tail = $prefix . $c1 . $radiko . $postfix;
            }
        } else {
            last;
        }
    }
       
    $tail =~ s/~/$radiko/g;

    if (lc(substr($radiko, 0, 1)) ne substr($radiko, 0, 1)) {
        my $word = $head;
           $word =~ s/\-//g;

        $tail .= " " . lc($word);
    }

    print "$head\t$tail\n";
}
