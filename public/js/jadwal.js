const API_URL = "https://api.aladhan.com/v1/timingsByCity?city=Tangerang&country=Indonesia&method=20";

// Peta penerjemahan nama salat ke Bahasa Indonesia
const prayerTranslations = {
  "Fajr": "Subuh",
  "Dhuhr": "Dzuhur",
  "Asr": "Ashar",
  "Maghrib": "Maghrib",
  "Isha": "Isya",
  "Sunrise": "Syuruq",
  "Tahajjud": "Tahajud",
  "Sunset": "Terbenam",
};

// Helper function to format time
function formatTime(timeString) {
  const [hours, minutes] = timeString.split(":");
  return `${hours.padStart(2, '0')}:${minutes.padStart(2, '0')}`;
}

// Fetch prayer times and display them
async function fetchPrayerTimes() {
  try {
    const response = await axios.get(API_URL);
    const timings = response.data.data.timings;

    // Get the current time
    const now = new Date();
    const currentTime = now.getHours() * 60 + now.getMinutes();

    let nextPrayer = null;
    let nextPrayerTime = null;

    const prayerTimesElement = document.getElementById("prayer-times");
    prayerTimesElement.innerHTML = ""; // Clear previous data

    // Get the first 6 prayers only
    const prayersList = Object.entries(timings).slice(0, 7);
    console.log(prayersList);

    const filteredPrayerTimes = prayersList.filter(([name]) => name !== 'Sunset');
    // Loop through the first 6 prayer times and find the next one
    filteredPrayerTimes.forEach(([prayer, time]) => {
      const [hours, minutes] = time.split(":");
      const prayerTime = parseInt(hours) * 60 + parseInt(minutes);

      // Translate prayer name to Indonesian
      const translatedPrayer = prayerTranslations[prayer] || prayer;

      // Mark the next prayer
      const isNext = nextPrayer === null && prayerTime > currentTime;
      if (isNext) {
        nextPrayer = translatedPrayer;
        nextPrayerTime = time;
      }

      // Append row to table
      const row = document.createElement("div");
      row.classList.add("col-md-4");
      row.classList.toggle("next-prayer", isNext);
      row.innerHTML = `
      <div class="mt-2 text-center">
        <div class="card-body">
          <h4 class="prayer-name">${translatedPrayer}</h5>
          <p class="prayer-hour">${formatTime(time)}</p>
        </div>                  
      </div>
      `;
      prayerTimesElement.appendChild(row);
    });

    // Update UI
    document.getElementById("current-time").innerText = `Waktu sekarang: ${now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}`;
    document.getElementById("next-prayer").innerText = nextPrayer
      ? `${nextPrayer} pada ${formatTime(nextPrayerTime)}`
      : "Tidak ada jadwal salat berikutnya hari ini.";
  } catch (error) {
    console.error("Error fetching prayer times:", error);
  }
}

// Run the function
fetchPrayerTimes();

// Optional: Auto-refresh every minute
setInterval(fetchPrayerTimes, 60000);
