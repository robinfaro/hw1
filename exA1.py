import numpy as np
# main
def main(n, k , A):
    # initialize the dp table
    dp = np.zeros((n, k))
    # fill the first column
    for i in range(n):
        dp[i, 0] = 2**(i+1) - 1
    # fill the first row 
    for i in range(k):
        if A[0] % (i+1) == 0:
            dp[0, i] = 1
        else:
            dp[0, i] = 0
    for j in range(1, k):
        for i in range(1, n):
            if A[i] % (j+1) == 0:
                dp[i, j] = dp[i-1, j] * 2 + 1
            else:   
                dp[i, j] = dp[i-1, j]
    
    return dp[n-1, k-1]

if __name__ == "__main__":
    args = input().split()
    n = int(args[0])
    k = int(args[1])
    A = list(map(int, input().split()))
    main(n, k, A)