import requests
import os
from github import Github

# Recupera il nome del repository e il numero della PR dalle variabili d'ambiente
repo_name = os.getenv("REPO_NAME")
pr_number = int(os.getenv("PR_NUMBER"))  # Usa il numero della PR che attiva l'azione

g = Github(os.getenv("GITHUB_TOKEN"))
repo = g.get_repo(repo_name)
pr = repo.get_pull(pr_number)

pr_data = {
    "repo_name": repo_name,
    "pr_number": pr_number
}

# Invia la richiesta al server
response = requests.post(os.getenv("API_URL"), json=pr_data)

# Ottieni la review generata dal modello
review = "# Review del modello QWEN allenato\n" + response.json().get("review", "No review generated") 
review_base = "# Review del modello QWEN base\n" + response.json().get("base_review", "No review base")

# Pubblica la review come commento sulla PR
pr.create_review(
    body=review,
    event="COMMENT"
)

pr.create_review(
    body=review_base,
    event="COMMENT"
)

print("Review posted successfully!")
