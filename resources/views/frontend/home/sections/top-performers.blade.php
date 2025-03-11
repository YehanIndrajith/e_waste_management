<style>
    .top-performers-section {
        background: linear-gradient(135deg, #e0f2f1, #b2dfdb);
        padding: 60px 0;
        font-family: 'Arial', sans-serif;
    }

    .top-performers-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .section-heading {
        text-align: center;
        margin-bottom: 40px;
        color: #00695c;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        position: relative;
    }

    .section-heading::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(to right, #00695c, #4db6ac);
    }

    .performer-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        margin-bottom: 30px;
    }

    .performer-card:hover {
        transform: translateY(-10px);
        border-color: #00695c;
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .performer-header {
        background: linear-gradient(to right, #00695c, #4db6ac);
        color: white;
        padding: 15px;
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .performer-body {
        padding: 20px;
    }

    .performer-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .performer-table th {
        background-color: #e0f2f1;
        color: #00695c;
        padding: 10px;
        text-align: left;
    }

    .performer-table td {
        padding: 10px;
        background-color: #f1f8e9;
        transition: background-color 0.3s ease;
    }

    .performer-table tr:hover td {
        background-color: #dcedc8;
    }

    .rank-badge {
        display: inline-block;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: linear-gradient(to right, #00695c, #4db6ac);
        color: white;
        text-align: center;
        line-height: 30px;
        font-weight: bold;
        margin-right: 10px;
    }

    .empty-state {
        text-align: center;
        color: #00695c;
        padding: 20px;
        background-color: #e0f2f1;
        border-radius: 10px;
    }

    @media (max-width: 768px) {
        .performer-card {
            margin-bottom: 20px;
        }
    }
</style>

<section class="top-performers-section">
    <div class="top-performers-container">
        <h2 class="section-heading">Top Quiz Performers</h2>
        
        <div class="row">
            @php $levels = ['beginner', 'intermediate', 'pro']; @endphp
            @foreach($levels as $level)
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="performer-card">
                        <div class="performer-header">
                            {{ ucfirst($level) }} Level Achievers
                        </div>
                        
                        <div class="performer-body">
                            @if(!$topPerformers[$level]->isEmpty())
                                <table class="performer-table">
                                    <thead>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Username</th>
                                            <th>Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topPerformers[$level] as $index => $performer)
                                            <tr>
                                                <td>
                                                    <span class="rank-badge">{{ $index + 1 }}</span>
                                                </td>
                                                <td>{{ $performer['username'] }}</td>
                                                <td>{{ $performer['marks'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="empty-state">
                                    <p>No performers found for this level</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>