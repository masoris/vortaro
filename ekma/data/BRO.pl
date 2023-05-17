#!/bin/env perl

sub load_BRO_one($$$$)
{
    my ($BRO, $file, $G, $BRO2) = @_;

    local(*F);
    if (! open(F, "$file")) {
        warn "-ERROR: open(F, $file) failed: $!";
        return;
    }
    my @lines = <F>;
    close(F);

    foreach my $line (@lines) {
        $line =~ s/\r?\n//g;

        if (defined $BRO->{$line}) {
            $BRO->{$line} .= ",$G";
        } else {
            $BRO->{$line} = "$G";
        }

        $BRO2->{lc($line)} = "$G";
        $BRO2->{uc(substr($line, 0, 1)) . lc(substr($line, 1))} = "$G";
    }
}

sub loadBRO()
{
    my $BRO = {};
    my $BRO2 = {};

    load_BRO_one($BRO, "Grupo-1.txt", "BRO-G1", $BRO2);
    load_BRO_one($BRO, "Grupo-2.txt", "BRO-G2", $BRO2);
    load_BRO_one($BRO, "Grupo-3.txt", "BRO-G3", $BRO2);
    load_BRO_one($BRO, "Grupo-4.txt", "BRO-G4", $BRO2);
    load_BRO_one($BRO, "Grupo-5.txt", "BRO-G5", $BRO2);
    load_BRO_one($BRO, "Grupo-6.txt", "BRO-G6", $BRO2);
    load_BRO_one($BRO, "Grupo-7.txt", "BRO-G7", $BRO2);
    load_BRO_one($BRO, "Grupo-8.txt", "BRO-G8", $BRO2);
    load_BRO_one($BRO, "Grupo-9.txt", "BRO-G9", $BRO2);

    return ($BRO, $BRO2);
}

sub loadVortaro($)
{
    my ($file) = @_;

    my $Vortaro = {};

    local(*F);
    if (! open(F, "$file")) {
        warn "-ERROR opne(F, $file) failed: $!";
        return;
    }
    my @lines = <F>;
    close(F);

    foreach my $line (@lines) {
        my ($key, $val) = split(/\s+/, $line, 2);
        $key =~ s/\s+$//g;
        $key =~ s/^\s+//g;
        $key =~ s/\s*\*\s*$//g;
        $key =~ s/\s*\.\s*$//g;

        $val =~ s/\s+$//g;
        $val =~ s/^\s+//g;
        $val =~ s/\s*\*\s*$//g;

        if (defined $Vortaro->{$key}) {
            $Vortaro->{$key} .= " " . $val;
        } else {
            $Vortaro->{$key} = $val;
        }
    }

    return $Vortaro;
}

sub is_match($$$)
{
    my ($BRO, $BRO2, $vorto) = @_;

    my @vortoj = ();
    push @vortoj, $vorto;

    if ($vorto =~ /^(.+)\-([aeiou])$/) {
        my $radiko = $1;
        push @vortoj, $radiko . "a";
        push @vortoj, $radiko . "e";
        push @vortoj, $radiko . "i";
        push @vortoj, $radiko . "o";
        push @vortoj, $radiko . "u";
    }

    foreach my $v (@vortoj) {
        if (defined $BRO->{$v}) { return ($BRO->{$v}, $v); }
        if (defined $BRO2->{$v}) { return ($BRO2->{$v}, $v); }
        my $v2 = lc($v);
        if (defined $BRO->{$v2}) { return ($BRO->{$v}, $v2); }
        if (defined $BRO2->{$v2}) { return ($BRO2->{$v2}, $v2); }
        my $v3 = uc(substr($v, 0, 1)) . lc(substr($v, 1));
        if (defined $BRO->{$v3}) { return ($BRO->{$v3}, $v3); }
        if (defined $BRO2->{$v3}) { return ($BRO2->{$v3}, $v3); }
    }

    return (undef, "");
}

MAIN:
{
    my ($BRO, $BRO2) = loadBRO();

    my $BRO_found = {};
    foreach my $key (keys %{$BRO}) {
        $BRO_found->{$key} = 0;
    }

    # print "BRO keys: " . scalar(keys %{$BRO}) . "\n";

    my $Vortaro = loadVortaro("./ma-hanes-utf8.txt.tab.all");
    foreach my $vorto (keys %{$Vortaro}) {
        my ($match, $found) = is_match($BRO, $BRO2, $vorto);
        if (defined $match) {
            $BRO_found->{$vorto} = 1;
            $BRO_found->{$found} = 1;
            print "$vorto\t\t<$match>\t\t$Vortaro->{$vorto}\n";
        } else {
            print "$vorto\t\t<BRO-GX>\t\t$Vortaro->{$vorto}\n";
        }
    }

#   foreach my $key (keys %{$BRO}) {
#       if (! $BRO_found->{$key}) {
#           print "NOT FOUND: $key\n";
#       }
#   }

    # print "Vortaro keys: " . scalar(keys %{$Vortaro}) . "\n";
}
