import os, json
from pathlib import Path
from datetime import datetime
from time import sleep
from certidoes import Bot

def main():
    cur_path = os.path.join(os.path.dirname(os.path.abspath(__file__)),'queue')
    out_path = os.path.join(os.path.dirname(os.path.abspath(__file__)),datetime.now().strftime("%Y"),datetime.now().strftime("%m"))
    log_file = os.path.join(os.path.dirname(os.path.abspath(__file__)),f'{datetime.now().strftime("%Y")}_log.log')
    #print(log_file)

    if os.path.exists(cur_path):
        queue = [f.name for f in os.scandir(cur_path) if f.is_file()]
        queue.sort(key=lambda x: x.split('_')[1] if '_' in x else x)

        print(f"Log ativado em: {log_file}\n")
        if queue:
            for q in queue:
                print(q)
               
def logBot(msg):
    log_file = os.path.join(os.path.dirname(os.path.abspath(__file__)),f'{datetime.now().strftime("%Y")}_log.log')

    with open(log_file, "a", encoding="utf-8") as log:
        log.write(msg)

if __name__ == "__main__":
    main()