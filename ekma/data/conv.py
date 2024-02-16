#!/bin/env python
#-*- coding: utf-8 -*-

import sys, os


def conv_letter(line):
#{
    line = unicode(line, "utf-8")
    line2 = u""
    for c in line:
        # print "'%s'" % (c)
        if c == u"Ĉ": line2 += u"Cx"
        elif c == u"ĉ": line2 += u"cx"
        elif c == u"Ĝ": line2 += u"Gx"
        elif c == u"ĝ": line2 += u"gx"
        elif c == u"Ĥ": line2 += u"Hx"
        elif c == u"ĥ": line2 += u"hx"
        elif c == u"Ĵ": line2 += u"Jx"
        elif c == u"ĵ": line2 += u"jx"
        elif c == u"Ŝ": line2 += u"Sx"
        elif c == u"ŝ": line2 += u"sx"
        elif c == u"Ŭ": line2 += u"Ux"
        elif c == u"ŭ": line2 += u"ux"
        elif c == u"①": line2 += u"1. "
        elif c == u"②": line2 += u"2. "
        elif c == u"③": line2 += u"3. "
        elif c == u"④": line2 += u"4. "
        elif c == u"⑤": line2 += u"5. "
        elif c == u"⑥": line2 += u"6. "
        elif c == u"⑦": line2 += u"7. "
        elif c == u"⑧": line2 += u"8. "
        elif c == u"⑨": line2 += u"9. "
        elif c == u"⑩": line2 += u"10. "
        elif c == u"☞": line2 += u"참조:"
        elif c == u"→": line2 += u"보기:"
        elif c == u"…": line2 += u"..."
        #elif c == u"<": line2 += u"("
        # elif c == u">": line2 += u")"
        elif c == u"・": line2 += u" "
        elif c == u"·": line2 += u"."
        elif c == u"㉠": line2 += u" "
        elif c == u"㉡": line2 += u" "
        elif c == u"㉢": line2 += u" "
        elif c == u"㉣": line2 += u" "
        elif c == u"㉤": line2 += u" "
        elif c == u"㉥": line2 += u" "
        elif c == u"㉦": line2 += u" "
        elif c == u"㉧": line2 += u" "
        elif c == u"㉨": line2 += u" "
        elif c == u"㉩": line2 += u" "
        elif c == u"㉪": line2 += u" "
        elif c == u"※": line2 += u" "
        elif ord(c) >= 0x3400 and ord(c) <= 0x4dbf: line2 += "" # 한자 제거
        elif ord(c) >= 0x4e00 and ord(c) <= 0x9fff: line2 += "" # 한자 제거
        elif ord(c) >= 0xf900 and ord(c) <= 0xfaff: line2 += "" # 한자 제거
        else:
            line2 += c
    return line2
#}

def get_morpheme(line2):
#{
    row = line2.split("\t")
    entry = row[0].split("-")
    if len(entry) == 0:
        return ("", "")

    morpheme = ""
    entry_str = ""
    if entry[0] == "":
        if len(entry) >= 2:
            entry_str = "-" + entry[1]
        else:
            return ("", "")

    elif len(entry) >= 2:
        entry_str = entry[0] + entry[1]
        morpheme = entry[0]
    elif len(entry) == 1:
        entry_str = entry[0]
        morpheme = entry[0]
       
    return (morpheme, entry_str)
#}

if __name__ == "__main__":
#{
    if len(sys.argv) < 2:
    #{
        print "Usage: %s file1" % (sys.argv[0])
        sys.exit(0)
    #}

    file1 = sys.argv[1]

    fp1 = open(file1, "r")

    for line in fp1.xreadlines():
        line2 = conv_letter(line)
        (morpheme, entry_str) = get_morpheme(line2)

        # print morpheme, entry_str

        line2 = line2.replace(u"～", morpheme)

        line2 = line2.replace("\t\t", "\t")
        line2 = line2.replace("<O_A>\t", "")
        line2 = line2.replace("<G_0>\t", "")
        line2 = line2.replace("<G_1>\t", "")
        line2 = line2.replace("<G_2>\t", "")
        line2 = line2.replace("<G_3>\t", "")
        line2 = line2.replace("<G_4>\t", "")
        line2 = line2.replace("<G_5>\t", "")
        line2 = line2.replace("<G_6>\t", "")
        line2 = line2.replace("<G_7>\t", "")
        line2 = line2.replace("<G_8>\t", "")
        line2 = line2.replace("<G_9>\t", "")
        line2 = line2.replace("<G_X>\t", "")
        # line2 = line2.replace(u"[타]", " ")
        # line2 = line2.replace(u"[자]", " ")
        line2 = line2.replace(u"()", "")
        line2 = line2.replace("\t\t", "\t")
        line2 = line2.replace("!", " ")

        kv = line2.split("\t", 1)
        kv[1] = kv[1].replace("\t", " ")
        kv[1] = kv[1].replace("  ", " ")

        print("! %s\t%s" % (entry_str.encode("utf-8"), kv[1].encode("utf-8"))),

    fp1.close()
#}
