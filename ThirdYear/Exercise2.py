"""
print('10 is 10:', 10 is 10)
print('10 is not 5:', 10 is not 5)
print('"P" in "Python":', 'P' in 'Python')
print('"z" in "Python":', 'z' in 'Python')
print('"learn" in "learn Python":', 'learn' in 'learn Python')
print('"e" in "hello":', 'e' in 'hello')
print('16 is 4 ** 2:', 16 is 4 ** 2)
print('"dog" in "hotdog":', 'dog' in 'hotdog')
print('"cat" in "caterpillar":', 'cat' in 'caterpillar')
print('100 is not 10 * 2:', 100 is not 10 * 2)




# Exercise 1: Fly me to the Moon
earth_weight = float(input("Insert your weight in kg.: "))
moon_weight = earth_weight * 0.165
print(f"In the moon you weight: {moon_weight} kg")


# Exercise 2: Light speed
light_speed_m = 299792458 #m/s
km = int(input('Insert KM: ')) #km
msToKm = km * 1000
time = msToKm/light_speed_m
print(f'Time for flying: {time} seconds')


# Exercise 3: Time on Earth
years=int(input('Your age: '))
year_born_on=int(input('Year you are born: '))
leap_year = years //4
print(f'You are on Earth since {years*(365-leap_year) + leap_year*366} days')


# Exercise 4: Tips
price = float(input('Insert the price value: '))


print(f"10% tips: {price*0.1} BGN")
print(f"15% tips: {price*0.15} BGN")
"""
# Individual


# Exercise 1: Odd or Even
"""
number = int(input('Insert a number: '))


if(number % 2 == 0):
    print(f'The number {number} is even.')
else:
    print(f'The number {number} is odd.')




# Exercise 2: Area of a Square
sideA = float(input('Inser side A of the square: '))
print(f'The area of the Square is: {sideA**2}')



# Excercise 3: Is the number positive


number = int(input('Insert a number: '))
if(number < 0):
    print(f'The number {number} is negative')
elif(number > 0):
    print(f"The number {number} is positive")
else: 
    print("The number is 0 (neutral)")


# Exercise 4: Sum of integers from 1 to n
num = int(input("Type a number: "))
numHolder = num
calc = 0

# Var1
print(f"The sum from 1 to {num} is: {sum(range(1,num+1))}")

# Var2
while int(numHolder) > 0:
    calc+=int(numHolder)
    numHolder-=1
print(f"The sum from 1 to {num} is: {calc}")"

# Exercise 5: Height check
height = int(input("Insert your height in cm.: "))
check = 170

if(height > check):
    print("You are a big boy!")
else:
    print("You aren't that tall")

num = int(input("Please write an integer: "))

fact = 1

for i in range(1, num+1):
    fact *= i 

print(f"The factorial is: {fact}")



# Exercise 7: Check if a is in abc

word = input("Please type a word: ")
letter = input("Type a letter: ")

if(letter.upper() in word.upper()):
    print(f"The letter {letter} is in {word}.")
else:
    print(f"The letter {letter} is not in {word}.")



# Exercise 8: Find the biggest number

numbers = input("Please write 3 numbers seperated by space: ")
numbersSplit = numbers.split()

print(f"The biggest number is: {max(numbersSplit)}")
"""