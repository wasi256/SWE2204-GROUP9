import math

# Define complexity weights for Function Point Analysis
FP_WEIGHTS = {
    "EI": {"Simple": 3, "Average": 4, "Complex": 6},
    "EO": {"Simple": 4, "Average": 5, "Complex": 7},
    "EQ": {"Simple": 3, "Average": 4, "Complex": 6},
    "ILF": {"Simple": 7, "Average": 10, "Complex": 15},
    "EIF": {"Simple": 5, "Average": 7, "Complex": 10},
}

def calculate_function_points(components):
    """Computes Function Points (FP) based on function types & complexity."""
    total_fp = 0
    for comp, details in components.items():
        count, complexity = details
        weight = FP_WEIGHTS[comp][complexity]
        total_fp += count * weight
    return total_fp

def apply_complexity_adjustment(fp, tcf):
    """Applies Complexity Adjustment Factor (CAF) to raw Function Points."""
    return fp * (0.65 + 0.01 * tcf)

def calculate_development_cost(fp, hours_per_fp, hourly_rate, exchange_rate):
    """Calculate project development cost in both USD and UGX using Function Points (FP)."""
    total_hours = fp * hours_per_fp
    total_cost_usd = total_hours * hourly_rate
    total_cost_ugx = total_cost_usd * exchange_rate  # Convert USD to UGX
    return total_hours, total_cost_usd, total_cost_ugx

# Example: Function Counts for the Hotel Booking Website
hotel_booking_components = {
    "EI": (10, "Average"),   # 10 external inputs (booking, login, search)
    "EO": (5, "Complex"),    # 5 external outputs (confirmation emails, invoices)
    "EQ": (8, "Average"),    # 8 external inquiries (room availability searches)
    "ILF": (7, "Complex"),   # 7 internal logical files (users, bookings, hotels)
    "EIF": (3, "Simple"),    # 3 external interface files (Payment API, Google Maps)
}

# Define Technical Complexity Factor (TCF) (Scale: 0-50)
TCF = 35

# Define Development Cost Parameters
HOURS_PER_FP = 15      # Developer productivity in hours per FP
HOURLY_RATE = 25       # Developer hourly rate ($)
EXCHANGE_RATE = 3800   # 1 USD = 3,800 UGX (can be updated dynamically)

# Compute Function Points
fp_total = calculate_function_points(hotel_booking_components)
fp_adjusted = apply_complexity_adjustment(fp_total, TCF)

# Compute cost
total_hours, total_cost_usd, total_cost_ugx = calculate_development_cost(fp_adjusted, HOURS_PER_FP, HOURLY_RATE, EXCHANGE_RATE)

# Print Results
print("\n📊 **Hotel Booking Website - Function Point & Cost Analysis** 📊")
print("=" * 80)
print(f"📌 Total Unadjusted Function Points: {fp_total}")
print(f"⚙️ Complexity Adjustment Factor (TCF): {TCF}")
print(f"✅ Adjusted Function Points: {fp_adjusted:.2f}")
print("-" * 80)
print(f"⏳ Estimated Hours per FP: {HOURS_PER_FP} Hours")
print(f"💰 Developer Cost per Hour: ${HOURLY_RATE}")
print(f"⚙️ Total Development Effort: {total_hours:.2f} Hours")
print(f"✅ Estimated Development Cost: ${total_cost_usd:,.2f} (USD)")
print(f"💵 Equivalent in Uganda Shillings: UGX {total_cost_ugx:,.2f}")
print("=" * 80)
