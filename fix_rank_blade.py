with open(r'resources\views\user\index.blade.php', 'r', encoding='utf-8') as f:
    lines = f.readlines()

new_section = (
    "<!-- \u2500\u2500\u2500 Rank Progress \u2500\u2500\u2500 -->\n"
    "  <div class=\"card border-themed mb-4\">\n"
    "    <div class=\"card-body\">\n"
    "      <div class=\"d-flex justify-content-between flex-wrap gap-2 mb-3\">\n"
    "        <h6 class=\"fw-heading mb-0\"><i class=\"fa-solid fa-medal me-2 text-warning\"></i>Rank Progress</h6>\n"
    "        <div class=\"small\">\n"
    "          <span class=\"badge me-1\"\n"
    "            style=\"background-color: {{ $currentRank['current_color'] }}; color:#fff;\">\n"
    "            {{ $currentRank['current_rank'] }}\n"
    "          </span>\n"
    "          @if($currentRank['next_rank'])\n"
    "            <i class=\"fa-solid fa-arrow-right mx-1 text-muted\"></i>\n"
    "            <span class=\"badge bg-secondary\">{{ $currentRank['next_rank'] }}</span>\n"
    "          @else\n"
    "            <i class=\"fa-solid fa-crown ms-1 text-warning\"></i>\n"
    "            <span class=\"text-warning small ms-1\">Max Rank!</span>\n"
    "          @endif\n"
    "        </div>\n"
    "      </div>\n"
    "      @if($currentRank['next_rank'])\n"
    "        <div class=\"progress mb-2\" style=\"height:14px;\">\n"
    "          <div class=\"progress-bar\"\n"
    "               style=\"width:{{ $currentRank['progress_pct'] }}%; background-color:{{ $currentRank['current_color'] }};\">\n"
    "            {{ $currentRank['progress_pct'] }}%\n"
    "          </div>\n"
    "        </div>\n"
    "        <div class=\"small text-muted\">\n"
    "          @if($currentRank['next_team'] > 0)\n"
    "            Team Size: <strong>{{ number_format($currentRank['team_size']) }}</strong> /\n"
    "            <strong>{{ number_format($currentRank['next_team']) }}</strong>\n"
    "            &mdash; Need <strong class=\"text-warning\">{{ number_format($currentRank['next_team'] - $currentRank['team_size']) }}</strong> more members\n"
    "          @endif\n"
    "          @if($currentRank['next_directs'] > 0)\n"
    "            &nbsp;| Direct Referrals: <strong>{{ $currentRank['direct_count'] }}</strong> /\n"
    "            <strong>{{ $currentRank['next_directs'] }}</strong>\n"
    "          @endif\n"
    "        </div>\n"
    "      @else\n"
    "        <div class=\"text-center py-2\">\n"
    "          <i class=\"fa-solid fa-crown fa-2x text-warning mb-2\"></i>\n"
    "          <p class=\"mb-0 small text-muted\">You have reached the highest rank &mdash; <strong>Diamond Crown</strong>!</p>\n"
    "        </div>\n"
    "      @endif\n"
    "    </div>\n"
    "  </div>\n"
)

# Lines 222-242 are 1-indexed => 0-indexed 221 to 241 (inclusive)
new_lines = lines[:221] + [new_section] + lines[242:]

with open(r'resources\views\user\index.blade.php', 'w', encoding='utf-8') as f:
    f.writelines(new_lines)

print('Done. Total lines:', len(new_lines))
