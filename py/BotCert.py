import os, sys

libs = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'libs')
sys.path.insert(0, libs)

import json
from pathlib import Path
from datetime import datetime
from time import sleep
from certidoes import Bot

def main():
    cur_path = os.path.join(os.path.dirname(os.path.abspath(__file__)),'queue')
    out_path = os.path.join(os.path.dirname(os.path.abspath(__file__)),datetime.now().strftime("%Y"),datetime.now().strftime("%m"))
    log_file = os.path.join(os.path.dirname(os.path.abspath(__file__)),f'{datetime.now().strftime("%Y")}_logBot.log')
    #print(log_file)

    if os.path.exists(cur_path):
        queue = [f.name for f in os.scandir(cur_path) if f.is_file()]
        queue.sort(key=lambda x: x.split('_')[1] if '_' in x else x)

        print(f"Log ativado em: {log_file}\n")
        if queue:
            for q in queue:
                request_name = os.path.splitext(q)[0]
                request_folder = os.path.join(out_path, request_name)
                request_result = os.path.join(request_folder,"resultado.json")

                os.makedirs(request_folder, exist_ok=True)             

                print(f"[[Recebendo a requisição:]] {q}")
                logBot(f"\n[[Recebendo a requisição:]] {q}")

                cnpj = q.split('_')[0] if '_' in q else q
                cur_request = os.path.join(cur_path, f"{request_name}.lock")

                cur_date = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
                try:
                    logBot(f"\n[{cur_date}] Processando o CNPJ: {cnpj}...")
                    print(f"[{cur_date}] Processando o CNPJ: {cnpj}...")

                    os.rename(os.path.join(cur_path, q), cur_request)
                    print('...')

                    #bot = Bot(cnpj, request_folder)
                    #result = bot.search()                    

                    cur_date = datetime.now().strftime("%Y-%m-%d %H:%M:%S")

                    with open(request_result, "w", encoding="utf-8") as log:
                        log.write(json.dumps(result, ensure_ascii=False, indent=4))

                    logBot(f"\n[{cur_date}] OK! Resultado CNPJ: {cnpj} em: {request_result}")
                    print(f"[{cur_date}] OK! Resultado CNPJ: {cnpj} em: {request_result}")
                except Exception as e:
                    print(f"Ops, deu erro no processamento do CNPJ: {cnpj}")
                    logBot(f"\nOps, deu erro no processamento do CNPJ: {cnpj}")
                finally:
                    if os.path.exists(cur_request):
                        logBot(f"\n[[Excluindo a requisição:]] {cur_request}")
                        print(f"[[Excluindo a requisição:]] {q}")
                        os.remove(cur_request)
                        pass
                    pass
                pass
def logBot(msg):
    log_file = os.path.join(os.path.dirname(os.path.abspath(__file__)),f'{datetime.now().strftime("%Y")}_logBot.log')

    with open(log_file, "a", encoding="utf-8") as log:
        log.write(msg)

if __name__ == "__main__":
    main()