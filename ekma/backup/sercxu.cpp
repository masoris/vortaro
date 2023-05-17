#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <assert.h>
#include <unistd.h>
#include <errno.h>

#include <string>
#include <vector>
#include <map>
#include <algorithm>

#ifndef NDEBUG
#  define DEBUG_PRINT printf("(%s,%d) ", __FILE__, __LINE__); printf
#else
#  define DEBUG_PRINT if (0) printf
#endif

static bool g_debug = false;
#define debug_print if (g_debug) printf

using namespace std;

void LOG(const string &str)
{
    FILE *fp = fopen("./sercxu.LOG", "a+");
    if (fp != NULL) {
        fprintf(fp, "%s\n", str.c_str());
        fclose(fp);
    }
}

vector<string> read_dict(const string &filename)
{
    vector<string> lines;

    FILE *fp = fopen(filename.c_str(), "r");
    if (fp != NULL) {
        char *buf = (char*) malloc(BUFSIZ * 10);
        while (fgets(buf, BUFSIZ*10, fp) != NULL) {
            lines.push_back(buf);
        }
        free(buf);
        fclose(fp);
    }
 
    return lines;
}


string StrUtil__trim_blanks(const string &str)
{
    int str_size = str.size();
    char *str2 = (char*) malloc(str_size+1);

    register int j = 0;
    register bool prev_blank = true;
    char *str_c_str = (char*) str.c_str();
    char *str2_c_str = (char*) str2;

    assert(str_c_str != str2_c_str);

    for (register int i = 0; i < str_size; i++) {
        if (str_c_str[i] == ' ' || str_c_str[i] == '\t' ||
            str_c_str[i] == '\n' || str_c_str[i] == '\r')
        {
            if (prev_blank) {
                // skip
            } else {
                str2_c_str[j] = ' ';
                prev_blank = true;
                j++;
            }
        } else {
            str2_c_str[j] = str_c_str[i];
            j++;
            prev_blank = false;
        }
    }

    if (j > 0 && prev_blank) {
        j--;
    }
    str2_c_str[j] = '\0';

    string a = str2;
    free(str2);
    return a;
}

int skip_delimiters(const string &str, int n, int idx, const string &delimiters)
{
    assert(idx >= 0);
    assert(n >= 0);

    for (int i = idx; i < n; i++) {
        if (strchr(delimiters.c_str(), str[i]) == NULL) {
            return i;
        }
    }
    return idx;
}

int find_wordend(const string &str, int n, int idx, const string &delimiters)
{
    assert(n >= 0);
    assert(idx >= 0);

    for (int i = idx; i < n; i++) {
        if (strchr(delimiters.c_str(), str[i]) != NULL) {
            return i;
        }
    }
    return n;
}

void strutil__split(const string& str, vector<string>& tokens, const string& delimiters)
{
    int i = 0, j = 0, n = str.size();
    while (i < n) {
        i = skip_delimiters(str, n, i, delimiters);
        j = find_wordend(str, n, i, delimiters);

        if (j <= i) { break; }

        assert(j > i);
        string word = str.substr(i, j-i);
               word = StrUtil__trim_blanks(word);

        tokens.push_back(word);
        i = j+1;
    }
}

string trim_suffix(string str)
{
    if (strchr("iouae-", str[str.length()-1]) != NULL) {
        str = str.substr(0, str.length()-1);
        if (str[str.length()-1] == '-') {
            str = str.substr(0, str.length()-1);
        }
    }

    return str;
}

string remove_braces(const string &str)
{
    string STR = str;
    while (true) {
        bool changed = false;
{
        char *p = strchr(STR.c_str(), '<');
        if (p != NULL) {
            char *q = strchr(p, '>');
            if (q != NULL) {
                STR = STR.substr(0, p-STR.c_str()) + STR.substr(q-STR.c_str()+1);
                changed = true;
            }
        }
}{
        char *p = strchr(STR.c_str(), '(');
        if (p != NULL) {
            char *q = strchr(p, ')');
            if (q != NULL) {
                STR = STR.substr(0, p-STR.c_str()) + STR.substr(q-STR.c_str()+1);
                changed = true;
            }
        }
}
{
        char *p = strstr(STR.c_str(), "《");
        if (p != NULL) {
            char *q = strstr(p, "《");
            if (q != NULL) {
                STR = STR.substr(0, p-STR.c_str()) + STR.substr(q-STR.c_str()+1);
                changed = true;
            }
        }
}

{
        char *p = strstr(STR.c_str(), "*");
        if (p != NULL) {
            char *q = strstr(p, " ");
            if (q != NULL) {
                STR = STR.substr(0, p-STR.c_str()) + STR.substr(q-STR.c_str()+1);
                changed = true;
            }
        }
}

        if (! changed) {
            break;
        }
    }

    return StrUtil__trim_blanks(STR);
}

int get_rank(int i, const string &splitted_i, const string &vorto)
{
//debug_print("rank+1, splitted[%d]:%s vorto:%s\n", i, splitted_i.c_str(), vorto.c_str());
    int rank = 1;

    if (i == 0 && strstr(splitted_i.c_str(), vorto.c_str()) == splitted_i.c_str()) {
        rank += 15;
//debug_print("rank+15, splitted[%d]:%s vorto:%s\n", i, splitted_i.c_str(), vorto.c_str());

        if (strcmp(trim_suffix(splitted_i).c_str(), trim_suffix(vorto).c_str()) == 0) {
            rank += 3;
//debug_print("rank+3, splitted[%d]:%s vorto:%s\n", i, splitted_i.c_str(), vorto.c_str());
        }
    }

    if (strcmp(splitted_i.c_str(), vorto.c_str()) == 0) {
        if (i == 0) {
            rank += 100;
//debug_print("rank+100, splitted[%d]:%s vorto:%s\n", i, splitted_i.c_str(), vorto.c_str());
        }

        rank += 29;
//debug_print("rank+29, splitted[%d]:%s vorto:%s\n", i, splitted_i.c_str(), vorto.c_str());
    }

    if (strstr(splitted_i.c_str(), vorto.c_str()) == splitted_i.c_str()) {
        rank += 4;
//debug_print("rank+4, splitted[%d]:%s vorto:%s\n", i, splitted_i.c_str(), vorto.c_str());
    }

    string v1 = " " + vorto + " ";
    if (strstr(splitted_i.c_str(), v1.c_str()) != NULL) {
        rank += 6;
//debug_print("rank+6, splitted[%d]:%s vorto:%s\n", i, splitted_i.c_str(), vorto.c_str());
    }

    vector<string> fragmented;
    strutil__split(splitted_i, fragmented, " ");
    for (int ii = 0, nn = fragmented.size(); ii < nn; ii++) {

        int position = 1;
        if (ii < 5) { position = 3; }
        else if (ii < 10) { position = 2; }
        else position = 1;

        if (strcmp(fragmented[ii].c_str(), vorto.c_str()) == 0) {
            rank += 3 * position;
        }
    }

    return rank;
}

int compute_rank(const vector<string> &splitted, const string &vorto)
{
//debug_print("splitted.size(): %d\n", splitted.size());
    int rank = 0;
    for (int i = 0, n = splitted.size(); i < n; i++) {
//debug_print("splitted[%d]:[%s] vorto:[%s]\n", i, splitted[i].c_str(), vorto.c_str());
        if (strstr(splitted[i].c_str(), vorto.c_str()) != NULL) {

            string splitted_i = splitted[i];
            rank += get_rank(i, splitted_i, vorto);

            splitted_i = remove_braces(splitted_i);
            rank += get_rank(i, splitted_i, vorto);
        }
    }

    return rank;
}

vector<string> search(const vector<string> &lines, const string &vorto)
{
    vector<string> result;

    for (int i = 0, n = lines.size(); i < n; i++) {
        int rank = 0;

/*
if (strstr(lines[i].c_str(), "am-i\t") == lines[i].c_str()) {
    g_debug = true;
} else {
    g_debug = false;
}
*/
        vector<string> splitted;
        strutil__split(lines[i], splitted, "\t,.;:='\"?!");

//for (int ii = 0, nn = splitted.size(); ii < nn; ii++) {
//    debug_print("splitted[%d][%s]\n", ii, splitted[ii].c_str());
//}

        bool found = false;

        if (vorto[0] == ' ') {
            if (strstr(splitted[0].c_str(), vorto.substr(1).c_str()) == splitted[0].c_str()) {
                // int tmp_rank1 = compute_rank(splitted, vorto);
                // if (tmp_rank1) { rank += tmp_rank1; }
                rank += 10;
                found = true;
            }
        }

        if (vorto.length() == 1) {
            if (strcmp(splitted[0].c_str(), vorto.c_str()) == 0) {
                rank += 10;
// debug_print("rank+10\n");
                found = true;
            }
        } else if (vorto.length() == 2) {
            if (strstr(splitted[0].c_str(), vorto.c_str()) == splitted[0].c_str()) {
                int tmp_rank1 = compute_rank(splitted, vorto);
// debug_print("rank+%d\n", tmp_rank1);
                if (tmp_rank1) { rank += tmp_rank1; }
                // rank += 10;
                found = true;
            }
        } else {
            int tmp_rank1 = compute_rank(splitted, vorto);
            if (tmp_rank1 > 0) {
// debug_print("rank+%d\n", tmp_rank1);
                rank += tmp_rank1;
            }

            if (strchr("ioeau", vorto[vorto.size()-1]) != NULL) {
                string v2 = vorto.substr(0, vorto.size()-1) + "-";
                int tmp_rank2 = compute_rank(splitted, v2);
                if (tmp_rank2 > 0) {
// debug_print("rank+%d\n", tmp_rank2);
                    rank += tmp_rank2; 
                }

                string v3 = vorto.substr(0, vorto.size()-1) + "-" + vorto.substr(vorto.size()-1,1);
                int tmp_rank3 = compute_rank(splitted, v3);
// debug_print("v3:[%s] tmp_rank3:%d\n", v3.c_str(), tmp_rank3);
                if (tmp_rank3 > 0) {
// debug_print("rank+%d\n", tmp_rank3);
                    rank += tmp_rank3;
                }
            }

// debug_print("rank=%d\n", rank);
            if (rank > 0) {
                found = true;
            }
        }

        if (found) {
            char buf[10];
            sprintf(buf, "%05d", rank);
            string rank_line = string(buf) + lines[i];
// debug_print("rank_line: %s\n", rank_line.c_str());
            result.push_back(rank_line);
        }
    }

    std::sort(result.rbegin(), result.rend());

    for (int i = 0, n = result.size(); i < n; i++) {
        result[i] = result[i].substr(5);
    }

    return result;
}

string StrUtil__replace(const string &str, const string &x, const string &y)
{
    string result = "";

    int from = 0, to = 0;

    char *str_c_str = (char*) str.c_str();
    char *x_c_str = (char*) x.c_str();
    int x_size = x.size();

    for (int i = 0, n = str.size(); i < n; i++) {
        if (strncmp(&str_c_str[i], x_c_str, x_size) == 0) {
            result += str.substr(from, to-from);
            result += y;

            from = i + x_size;
            to = from;

            i += x_size - 1;
        } else {
            to++;
            // result += str.substr(i, 1);
        }
    }

    if (to > from) {
        result += str.substr(from, to-from);
    }

    return result;
}


vector<string> highlight(const vector<string> &lines, string vorto)
{
    // $result = "<LI><b>" . $result;
    // $result = str_replace("\n", "<hr><LI><b>", $result);
    // $result = str_replace("\t", "</b>\t", $result);
    // $result = str_replace("$vorto", "<font color=blue><b>$vorto</b></font>", $result);

    vector<string> new_lines;

    if (vorto[0] == ' ') {
        vorto = vorto.substr(1);
    }

    for (int i = 0, n = lines.size(); i < n; i++) {
        new_lines.push_back(lines[i]);
        new_lines[i] = StrUtil__replace(new_lines[i], vorto, string("<font color=blue><b>") + vorto + string("</b></font>"));
        new_lines[i] = string("<b>") + StrUtil__replace(new_lines[i], "\t", "</b>&nbsp;&nbsp;") + string("<hr>");

        new_lines[i] = StrUtil__replace(new_lines[i], "<G_1>", "<b><font size=-1 color=green>[G1]</font></b>");
        new_lines[i] = StrUtil__replace(new_lines[i], "<G_2>", "<b><font size=-1 color=green>[G2]</font></b>");
        new_lines[i] = StrUtil__replace(new_lines[i], "<G_3>", "<b><font size=-1 color=green>[G3]</font></b>");
        new_lines[i] = StrUtil__replace(new_lines[i], "<G_4>", "<b><font size=-1 color=green>[G4]</font></b>");
        new_lines[i] = StrUtil__replace(new_lines[i], "<G_5>", "<b><font size=-1 color=green>[G5]</font></b>");
        new_lines[i] = StrUtil__replace(new_lines[i], "<G_6>", "<b><font size=-1 color=green>[G6]</font></b>");
        new_lines[i] = StrUtil__replace(new_lines[i], "<G_7>", "<b><font size=-1 color=green>[G7]</font></b>");
        new_lines[i] = StrUtil__replace(new_lines[i], "<G_8>", "<b><font size=-1 color=green>[G8]</font></b>");
        new_lines[i] = StrUtil__replace(new_lines[i], "<G_9>", "<b><font size=-1 color=green>[G9]</font></b>");
        new_lines[i] = StrUtil__replace(new_lines[i], "<G_X>", "");
    }

    if (strchr("aeiou", vorto[vorto.size()-1]) != NULL) {
        string v2 = vorto.substr(0, vorto.size()-1) + "-";
        for (int i = 0, n = lines.size(); i < n; i++) {
            new_lines[i] = StrUtil__replace(new_lines[i], v2, string("<font color=blue><b>") + v2 + string("</b></font>"));
        }
    }

    return new_lines;
}

int main(int argc, char* argv[])
{
    if (argc < 2) {
        printf("Usage: %s 'vorto' [dictionary]\n", argv[0]);
        exit(0);
    }

    string dictionary = "./join-hajpin-ma-sort.txt.ext";

    if (argc >= 3) {
        dictionary = argv[2];
    }

    vector<string> lines = read_dict(dictionary);

    LOG(string("argv[1]: [") + string(argv[1]) + string("]"));

    string word = argv[1];
    vector<string> result = search(lines, word);
    if (result.size() == 0) {
        std::transform(word.begin(), word.end(), word.begin(), ::tolower);
        result = search(lines, word);
    }

    result = highlight(result, word);

    for (int i = 0, n = result.size(); i < n; i++) {
        printf("%s\n", result[i].c_str());
    }

}
