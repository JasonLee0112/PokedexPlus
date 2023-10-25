import requests
from bs4 import BeautifulSoup
import pandas as pd

url = 'https://pokemondb.net/move/all'

# Send a request to get the content of the page
response = requests.get(url)
soup = BeautifulSoup(response.text, 'html.parser')

# Find the table on the webpage
poke_table = soup.find_all('table')[0] 

# Extract the text in the table rows
rows = poke_table.find_all('tr')
row_list = list()

# Extracting text from the rows
for tr in rows:
    td = tr.find_all('td')
    row = [i.text for i in td]
    row_list.append(row)

# Create a pandas DataFrame from the list of rows
df = pd.DataFrame(row_list, columns=['Name', 'Type', 'Category', 'Power', 'Accuracy', 'PP', 'Effect', 'Hit Chance'])

# Remove the first empty row
df = df.dropna()

# Save DataFrame to CSV
df.to_csv('moves.csv', index=False)