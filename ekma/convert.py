# 마영태 사전 엑셀을 다운로드 받은 esp-kor, kor-esp를 읽어서 dic.tsv로 통합 생성

lines = []

fp = open("esp-kor.tsv", "r")
for i, line in enumerate(fp):
    if i == 0: continue
    lines.append(line)
fp.close

fp = open("kor-esp.tsv", "r")
for i, line in enumerate(fp):
    if i == 0: continue
    lines.append(line)
fp.close

fp = open("dic.tsv" , "w")
for line in lines:
    fp.write(line)
fp.close
