<h2 class="section-title"><i class="fa-solid fa-sack-dollar"></i> Profits</h2>
<div class="custom-row">
    <div class="custom-section profits">
        <h2>${{number_format($allData['todayProfit'], 2, ',', ' ')}}</h2>
        <p>Today's Profits</p>
    </div>
    <div class="custom-section profits">
        <h2>${{number_format($allData['weeklyProfit'], 2, ',', ' ')}}</h2>
        <p> Weekly Profits</p>
    </div>
    <div class="custom-section profits">
        <h2>${{number_format($allData['monthlyProfit'], 2, ',', ' ')}}</h2>
        <p>Monthly Profits</p>
    </div>
    <div class="custom-section profits">
        <h2>${{number_format($allData['totalProfit'], 2, ',', ' ')}}</h2>
        <p>Total Profits</p>     
    </div>
</div>