import os
import re
import math
from collections import Counter

# Define supported file extensions
SUPPORTED_EXTENSIONS = ['.php', '.js', '.py']

# Regex patterns to identify operators
OPERATORS = set(['+', '-', '*', '/', '%', '=', '==', '!=', '<', '>', '<=', '>=', '&&', '||', '!', 
                 '+=', '-=', '*=', '/=', '%=', '++', '--', '>>', '<<', '&', '|', '^', '~', '=>'])

# Function to tokenize code and extract operators & operands
def extract_tokens(code):
    tokens = re.findall(r'\b[a-zA-Z_][a-zA-Z0-9_]*\b|[^\w\s]', code)
    operators, operands = [], []
    
    for token in tokens:
        if token in OPERATORS:
            operators.append(token)
        elif re.match(r'^[a-zA-Z_][a-zA-Z0-9_]*$', token):  # Variable names, function names
            operands.append(token)

    return operators, operands

# Function to compute Halstead’s metrics
def calculate_halstead_metrics(file_path):
    with open(file_path, 'r', encoding='utf-8', errors='ignore') as f:
        code = f.read()
    
    operators, operands = extract_tokens(code)

    n1 = len(set(operators))  # Unique operators
    n2 = len(set(operands))   # Unique operands
    N1 = len(operators)       # Total occurrences of operators
    N2 = len(operands)        # Total occurrences of operands

    # Prevent division by zero
    if n1 == 0 or n2 == 0:
        return None

    program_vocabulary = n1 + n2
    program_length = N1 + N2
    volume = program_length * math.log2(program_vocabulary) if program_vocabulary > 0 else 0
    difficulty = (n1 / 2) * (N2 / n2) if n2 > 0 else 0
    effort = difficulty * volume

    return {
        "File": file_path,
        "Unique Operators (n1)": n1,
        "Unique Operands (n2)": n2,
        "Total Operators (N1)": N1,
        "Total Operands (N2)": N2,
        "Program Vocabulary (n)": program_vocabulary,
        "Program Length (N)": program_length,
        "Volume (V)": round(volume, 2),
        "Difficulty (D)": round(difficulty, 2),
        "Effort (E)": round(effort, 2)
    }

# Scan project directory for files and calculate Halstead metrics
def scan_project_for_complexity(directory):
    results = []

    for root, _, files in os.walk(directory):
        for file in files:
            extension = os.path.splitext(file)[1]
            if extension in SUPPORTED_EXTENSIONS:
                file_path = os.path.join(root, file)
                metrics = calculate_halstead_metrics(file_path)
                if metrics:
                    results.append(metrics)

    return results

# Generate a complexity report
def generate_report(results):
    print("\n📊 **Hotel Booking Website - Halstead Complexity Report** 📊")
    print("="*80)
    
    for result in results:
        print(f"\n📂 **File:** {result['File']}")
        print(f"  📌 Unique Operators (n1): {result['Unique Operators (n1)']}")
        print(f"  📌 Unique Operands (n2): {result['Unique Operands (n2)']}")
        print(f"  📌 Total Operators (N1): {result['Total Operators (N1)']}")
        print(f"  📌 Total Operands (N2): {result['Total Operands (N2)']}")
        print(f"  🔢 Program Vocabulary (n): {result['Program Vocabulary (n)']}")
        print(f"  🔢 Program Length (N): {result['Program Length (N)']}")
        print(f"  📏 Volume (V): {result['Volume (V)']}")
        print(f"  🎯 Difficulty (D): {result['Difficulty (D)']}")
        print(f"  💡 Effort (E): {result['Effort (E)']}")
        print("="*80)

# Run script
if __name__ == "__main__":
    project_directory = input("Enter the path to your Hotel Booking Website project: ")
    results = scan_project_for_complexity(project_directory)
    generate_report(results)
