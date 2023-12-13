<h2 class="section-title"><i class="fa-solid fa-money-bill"></i> Incomes</h2>
<div class="custom-row">
    <div class="custom-section income">
        <h2> ${{number_format($allData['todayIncome'], 2, ',', ' ')}}</h2>
        <p>Today's Income</p>
    </div>
    <div class="custom-section income">
        <h2>${{number_format($allData['weeklyIncome'], 2, ',', ' ')}}</h2>
        <p> Weekly Income</p>
    </div>
    <div class="custom-section income">
        <h2>${{number_format($allData['monthlyIncome'], 2, ',', ' ')}}</h2>
        <p>Monthly Income</p>
    </div>
    <div class="custom-section income">
        <h2>${{number_format($allData['totalIncome'], 2, ',', ' ')}}</h2>
        <p>Total Income</p>     
    </div>
</div>