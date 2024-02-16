fp = open("dic.tsv","r")
for line in fp:
    row = line.strip().split('\t')
    if len(row) < 5:
        print("ERROR" + line)
        continue
    if len(row) > 5:
        row[4] = " ".join(row[4:])
    print("%s\t%s\t%s" % (row[0], row[2], row[4].replace("\t", " ")))
fp.close()
