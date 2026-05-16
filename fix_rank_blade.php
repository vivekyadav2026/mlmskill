<?php
$file = __DIR__ . '/resources/views/user/index.blade.php';
$lines = file($file, FILE_BINARY);

$new_section = <<<'BLADE'
<!-- ─── Rank Progress ─── -->
  <div class="card border-themed mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between flex-wrap gap-2 mb-3">
        <h6 class="fw-heading mb-0"><i class="fa-solid fa-medal me-2 text-warning"></i>Rank Progress</h6>
        <div class="small">
          <span class="badge me-1"
            style="background-color: {{ $currentRank['current_color'] }}; color:#fff;">
            {{ $currentRank['current_rank'] }}
          </span>
          @if($currentRank['next_rank'])
            <i class="fa-solid fa-arrow-right mx-1 text-muted"></i>
            <span class="badge bg-secondary">{{ $currentRank['next_rank'] }}</span>
          @else
            <i class="fa-solid fa-crown ms-1 text-warning"></i>
            <span class="text-warning small ms-1">Max Rank!</span>
          @endif
        </div>
      </div>
      @if($currentRank['next_rank'])
        <div class="progress mb-2" style="height:14px;">
          <div class="progress-bar"
               style="width:{{ $currentRank['progress_pct'] }}%; background-color:{{ $currentRank['current_color'] }};">
            {{ $currentRank['progress_pct'] }}%
          </div>
        </div>
        <div class="small text-muted">
          @if($currentRank['next_team'] > 0)
            Team Size: <strong>{{ number_format($currentRank['team_size']) }}</strong> /
            <strong>{{ number_format($currentRank['next_team']) }}</strong>
            &mdash; Need <strong class="text-warning">{{ number_format($currentRank['next_team'] - $currentRank['team_size']) }}</strong> more members
          @endif
          @if($currentRank['next_directs'] > 0)
            &nbsp;| Direct Referrals: <strong>{{ $currentRank['direct_count'] }}</strong> /
            <strong>{{ $currentRank['next_directs'] }}</strong>
          @endif
        </div>
      @else
        <div class="text-center py-2">
          <i class="fa-solid fa-crown fa-2x text-warning mb-2"></i>
          <p class="mb-0 small text-muted">You have reached the highest rank &mdash; <strong>Diamond Crown</strong>!</p>
        </div>
      @endif
    </div>
  </div>

BLADE;

// Lines 222-242 are 1-indexed => 0-indexed 221 to 241 (inclusive)
$new_lines = array_slice($lines, 0, 221);
$new_lines[] = $new_section;
$new_lines = array_merge($new_lines, array_slice($lines, 242));

file_put_contents($file, implode('', $new_lines));
echo "Done. Total lines: " . count($new_lines) . "\n";
