import os
import re

# Define file extensions and their respective comment patterns
COMMENT_PATTERNS = {
    ".py": r"^\s*#",
    ".php": r"^\s*//|^\s*/\|^\s\*",
    ".js": r"^\s*//|^\s*/\|^\s\*",
    ".css": r"^\s*/\|^\s\*",
    ".html": r"^\s*<!--",
}

def count_lines(file_path, extension):
    """ Count total lines, blank lines, comment lines, and actual code lines (NCLOC). """
    total_lines = blank_lines = comment_lines = code_lines = 0
    comment_pattern = COMMENT_PATTERNS.get(extension, None)

    with open(file_path, "r", encoding="utf-8", errors="ignore") as file:
        for line in file:
            total_lines += 1
            stripped_line = line.strip()
            
            if stripped_line == "":
                blank_lines += 1
            elif comment_pattern and re.match(comment_pattern, stripped_line):
                comment_lines += 1
            else:
                code_lines += 1  # Non-Commented Lines of Code (NCLOC)

    return total_lines, blank_lines, comment_lines, code_lines

def scan_directory(directory):
    """ Recursively scan a project directory and analyze LOC for relevant files. """
    loc_summary = {}

    for root, _, files in os.walk(directory):
        for file in files:
            extension = os.path.splitext(file)[1]
            if extension in COMMENT_PATTERNS.keys():  # Check if it's a source code file
                file_path = os.path.join(root, file)
                total, blank, comments, ncloc = count_lines(file_path, extension)
                
                loc_summary[file_path] = {
                    "Total LOC": total,
                    "Blank LOC": blank,
                    "Comment LOC": comments,
                    "NCLOC": ncloc
                }

    return loc_summary

def generate_report(loc_summary):
    """ Print the LOC statistics for each file and total project LOC. """
    total_project_loc = {"Total LOC": 0, "Blank LOC": 0, "Comment LOC": 0, "NCLOC": 0}
    
    print("\n📊 *Hotel Booking Website - LOC Analysis Report* 📊")
    print("="*60)
    for file, stats in loc_summary.items():
        print(f"\n📂 *File:* {file}")
        print(f"  📌 Total LOC: {stats['Total LOC']}")
        print(f"  📌 Blank LOC: {stats['Blank LOC']}")
        print(f"  📌 Comment LOC: {stats['Comment LOC']}")
        print(f"  ✅ NCLOC (Code Only): {stats['NCLOC']}")
        
        # Summing up for the total project LOC
        for key in total_project_loc:
            total_project_loc[key] += stats[key]
    
    # Print project-wide summary
    print("\n📈 *Overall Project LOC Summary* 📈")
    print("="*60)
    print(f"📌 Total Project LOC: {total_project_loc['Total LOC']}")
    print(f"📌 Total Blank LOC: {total_project_loc['Blank LOC']}")
    print(f"📌 Total Comment LOC: {total_project_loc['Comment LOC']}")
    print(f"✅ Total NCLOC (Code Only): {total_project_loc['NCLOC']}")

# Run script
if __name__ == "__main__":
    project_directory = input("Enter the path to your Hotel Booking Website project: ")
    loc_data = scan_directory(project_directory)
    generate_report(loc_data)
