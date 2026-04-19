
<h2 class="page-title">Showing 8 Facilities</h2>
@if(session('success'))
    <div style="background: #28a745; color: white; padding: 15px; border-radius: 10px; margin-bottom: 20px; text-align: center; font-weight: bold; box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);">
        {{ session('success') }}
    </div>
@endif

<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search Here...">
</div>

<div class="filters">
    <button class="filter-btn active" data-type="all">All Facilities</button>
    <button class="filter-btn" data-type="classroom">Classrooms</button>
    <button class="filter-btn" data-type="lab">Computer Labs</button>
    <button class="filter-btn" data-type="conference">Conference Rooms</button>
    <button class="filter-btn" data-type="auditorium">Auditoriums</button>
</div>

<div class="card-grid">
    <div class="facility-card classroom" data-name="Room 301">
        <img src="https://i.pinimg.com/1200x/c0/c0/e4/c0c0e43255d9adcff141a7eb54a04e83.jpg" class="facility-img">
        <div class="card-body">
            <h3>Room 301</h3>
            <p>Standard classroom with modern facilities</p>
            <p><strong>Capacity:</strong> 40 Persons</p>
            <p><strong>Equipment:</strong> Whiteboard, LED Projector, Air-conditioning</p>
            <p>Main Building, Floor 3</p>
            <button class="book-btn">Book This Facility</button>
        </div>
    </div>

    <div class="facility-card classroom" data-name="Room 309">
        <img src="https://i.pinimg.com/1200x/c0/c0/e4/c0c0e43255d9adcff141a7eb54a04e83.jpg" class="facility-img">
        <div class="card-body">
            <h3>Room 309</h3>
            <p>Spacious classroom for lectures and discussions</p>
            <p><strong>Capacity:</strong> 35 Persons</p>
            <p><strong>Equipment:</strong> Whiteboard, Projector, Air-conditioning</p>
            <p>Main Building, Floor 3</p>
            <button class="book-btn">Book This Facility</button>
        </div>
    </div>

    <div class="facility-card lab" data-name="Computer Lab 1">
        <img src="https://scontent.fmnl17-5.fna.fbcdn.net/v/t39.30808-6/661033899_4407722402814708_8888488746983101949_n.jpg?stp=cp6_dst-jpg_tt6&_nc_cat=110&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeGzuKNA6LKQarf4ga7trUlV3QGPRxU5IdzdAY9HFTkh3E-Ey_OixMZV20grGA3qOlpTjq-FjHRp8CEE5nFqaF2S&_nc_ohc=qlYSYdOIQ10Q7kNvwGEr5XF&_nc_oc=AdoV9FgExcFLwyYvY8nuIuUewPTgINgdYquXo4CI-0q_jOwOOTaUcwOhojYCt1z6Qd0&_nc_zt=23&_nc_ht=scontent.fmnl17-5.fna&_nc_gid=dWqaY-Xqu4CwhRg_7Ghupg&_nc_ss=7a3a8&oh=00_Af1uaC9lbe-CbYQB-P4duCAygyAeIBTSNbg8KppNULtt3g&oe=69E599CA" class="facility-img">
        <div class="card-body">
            <h3>Computer Lab 1</h3>
            <p>Fully equipped computer laboratory</p>
            <p><strong>Capacity:</strong> 30 Persons</p>
            <p><strong>Equipment:</strong> 30 High-spec PCs, LAN, Projector, Whiteboard, Air-conditioning</p>
            <p>Main Building, Floor 3</p>
            <button class="book-btn">Book This Facility</button>
        </div>
    </div>

    <div class="facility-card lab" data-name="Computer Lab 2">
        <img src="https://scontent.fmnl17-1.fna.fbcdn.net/v/t39.30808-6/659783722_4407722432814705_4751854789425855573_n.jpg?stp=cp6_dst-jpg_tt6&_nc_cat=100&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeFf4Agmw89RpWCy7bDMLQESITUQJaYqU7EhNRAlpipTsdcjrIyu7Z2fufMDTpfmnvC3EQy8PdBF_xkO8y93xmzy&_nc_ohc=8Taq0x7azp4Q7kNvwGYf7jg&_nc_oc=AdqkMhwDFg3yJvRCgf4gnDoD4wu-foexgsf_FAIQ790paYfOAl-PNWz-OsJSp7Gg4jo&_nc_zt=23&_nc_ht=scontent.fmnl17-1.fna&_nc_gid=H1aABZPPPsSzHqxEtmsIUA&_nc_ss=7a3a8&oh=00_Af3iProUUL0STMsv1pitx9SUeOwxVHOjB7OADeOX-KcjIQ&oe=69E57A6D" class="facility-img">
        <div class="card-body">
            <h3>Computer Lab 2</h3>
            <p>Programming and development lab</p>
            <p><strong>Capacity:</strong> 30 Persons</p>
            <p><strong>Equipment:</strong> 30 PCs, LAN, Projector, Whiteboard, Air-conditioning</p>
            <p>Main Building, Floor 3</p>
            <button class="book-btn">Book This Facility</button>
        </div>
    </div>

    <div class="facility-card conference" data-name="Artist Hall">
        <img src="https://scontent.fmnl17-3.fna.fbcdn.net/v/t39.30808-6/658310155_4407722009481414_5347336690730675121_n.jpg?stp=cp6_dst-jpg_tt6&_nc_cat=103&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeH_Zw0xphrwTbVUwY2UiOhTdxaHnnuOd8p3Foeee453yoAmMYf8UuAhbXxpyUna9-fKvr_B25QGMdX2tCycv_Ff&_nc_ohc=XZovs_jEr5gQ7kNvwFdKQvd&_nc_oc=Adoi9S6J626PSS7f1S1TtyRso2myjvZMbtumdQfkevkvTXTKc7Nrtbd-NDTfKC-hHpo&_nc_zt=23&_nc_ht=scontent.fmnl17-3.fna&_nc_gid=M1Kf0_WF_B4YJbZuiqt4Jw&_nc_ss=7a3a8&oh=00_Af1BLlF1EO6VB5iZ2kjHzANqx7QK_YnXWvX7E5eaWPVBUg&oe=69E5A163" class="facility-img">
        <div class="card-body">
            <h3>Artist Hall</h3>
            <p>Performance hall with a stage setup for cultural shows, presentations, rehearsals, and school events</p>
            <p><strong>Capacity:</strong> 200 Persons</p>
            <p><strong>Equipment:</strong> Projector, Sound System, 2 Wireless Mics, VIP Seating</p>
            <p>Main Building, Floor 3</p>
            <button class="book-btn">Book This Facility</button>
        </div>
    </div>

    <div class="facility-card conference" data-name="Kenetics">
        <img src="https://scontent.fmnl17-1.fna.fbcdn.net/v/t39.30808-6/657654186_4407722026148079_5950631958570750206_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeH9HA69ZvCbVvZ5RxXrx-jhbrBNPg31y3VusE0-DfXLdSi6zjCY4tYiGwFybvxA4M7BAnWNgxyblChhc77-zzcq&_nc_ohc=H81VBj-KOvsQ7kNvwE-_gKG&_nc_oc=Ado7aFdi4cBMTuYjS_QHrbt92m81r1fLdzaLcmTy5GN1E8YSFclz5RqoAUNlDOP6Z9g&_nc_zt=23&_nc_ht=scontent.fmnl17-1.fna&_nc_gid=5ZZULcrybuEgwIDRFDhK8g&_nc_ss=7a3a8&oh=00_Af3tMcuztSASX43u4_0IOyL-BqxwB2XEwCtMg-C19y5O0A&oe=69E579AE" class="facility-img">
        <div class="card-body">
            <h3>Kenetics</h3>
            <p>Indoor gymnasium and sports hall used for basketball, physical education activities, sports practice, and large indoor events.</p>
            <p><strong>Capacity:</strong> 200 Persons</p>
            <p><strong>Equipment:</strong> Basketball Court, Projector, Stage, Wireless Mics, Sound System,</p>
            <p>Main Building, Floor 4</p>
            <button class="book-btn">Book This Facility</button>
        </div>
    </div>

    <div class="facility-card auditorium" data-name="Library">
        <img src="https://scontent.fmnl17-4.fna.fbcdn.net/v/t39.30808-6/656819075_4407722006148081_4789146048546620244_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeEutRJRApG0l4AZRd88tgWR4QLZhJsWI_bhAtmEmxYj9pKNTgEIetBbQM7ZQZW3yOA_cXz_XHVrVQNxc7xfJbSl&_nc_ohc=4bmhQJf_LcwQ7kNvwGgS_80&_nc_oc=AdqJdd8LrbrRqHUMuQ5o_04c6ZnNoAqGlbiBe3r85gy2MRYT-kciuUhQ0VdgOFKM_Hw&_nc_zt=23&_nc_ht=scontent.fmnl17-4.fna&_nc_gid=moMQBRaCjTgKECZbdYg3Ng&_nc_ss=7a3a8&oh=00_Af2jXFmmOH0Hoq_9DLuwe1e9wGWKwtpDRZwURUchALLcMw&oe=69E59AC0" class="facility-img">
        <div class="card-body">
            <h3>Library</h3>
            <p>Collaborative learning space for studying, group work, research, and student discussions.</p>
            <p><strong>Capacity:</strong> 40 Persons</p>
            <p><strong>Equipment:</strong> Reference Books, Study Cubicles, Desktops</p>
            <p>Main Building, Floor 3</p>
            <button class="book-btn">Book This Facility</button>
        </div>
    </div>

    <div class="facility-card auditorium" data-name="Amphitheater">
        <img src="https://scontent.fmnl17-3.fna.fbcdn.net/v/t39.30808-6/657250803_4407722086148073_4284449190172917065_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeGtpMzNu7PsePPGoe6I5e40cEQKyvqBLGxwRArK-oEsbG_LO2w5D8CMZF1RhL1f3K8mR-zxhfsofUq4v342BXlU&_nc_ohc=tIouPLbjlGcQ7kNvwHUvVk4&_nc_oc=AdpvYc2lsRaDDKW5D7_QQTDAnY-yCNURZsIThLNeTytMsZvWUObh5aA3BoGEMZhU4KM&_nc_zt=23&_nc_ht=scontent.fmnl17-3.fna&_nc_gid=0ND1v6i6wXYjPsIlYgqspA&_nc_ss=7a3a8&oh=00_Af2W93bnCKAKTXyPnCvtRCKdlk9V6FHAORZR58QFFOkVcg&oe=69E588B8" class="facility-img">
        <div class="card-body">
            <h3>Amphitheater</h3>
            <p>Smaller auditorium for departmental events</p>
            <p><strong>Capacity:</strong> 80 Persons</p>
            <p><strong>Equipment:</strong> Tiered Seating, Sound System, Portable Podium</p>
            <p>Main Building, Floor 3</p>
            <button class="book-btn">Book This Facility</button>
        </div>
    </div>

    <div id="bookingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); z-index: 9999; justify-content: center; align-items: center;">
    <div style="background: white; width: 90%; max-width: 500px; padding: 30px; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
        <h2 id="displayRoomName" style="margin-top: 0;">Facility Name</h2>
        <p style="color: #666; font-size: 0.9rem;">Fill in the details below to reserve this facility</p>

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="facility_name" id="inputRoomName">

            <div style="display: flex; gap: 15px; margin-top: 20px;">
                <div style="flex: 1;">
                    <label style="font-size: 0.8rem; font-weight: bold;">Full Name</label>
                    <input type="text" name="full_name" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
                </div>
                <div style="flex: 1;">
                    <label style="font-size: 0.8rem; font-weight: bold;">Department</label>
                    <input type="text" name="department" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
                </div>
            </div>

            <div style="margin-top: 15px;">
                <label style="font-size: 0.8rem; font-weight: bold;">Date</label>
                <input type="date" name="date" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
            </div>

            <div style="display: flex; gap: 15px; margin-top: 15px;">
                <div style="flex: 1;">
                    <label style="font-size: 0.8rem; font-weight: bold;">Start Time</label>
                    <input type="time" name="start_time" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
                </div>
                <div style="flex: 1;">
                    <label style="font-size: 0.8rem; font-weight: bold;">End Time</label>
                    <input type="time" name="end_time" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
                </div>
            </div>

            <div style="margin-top: 15px;">
                <label style="font-size: 0.8rem; font-weight: bold;">Purpose</label>
                <textarea name="purpose" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;"></textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 25px;">
                <button type="button" id="closeModal" style="padding: 10px 20px; border-radius: 8px; border: 1px solid #ccc; background: #fff; cursor: pointer;">Cancel</button>
                <button type="submit" style="padding: 10px 20px; border-radius: 8px; border: none; background: #7d70fa; color: white; cursor: pointer;">Submit Reservation</button>
            </div>
        </form>
    </div>
</div>

</div>

<script>
    // This runs immediately inside the page to bypass external file issues
    document.addEventListener('DOMContentLoaded', function() {
        const overlay = document.getElementById('bookingOverlay');
        const closeBtn = document.getElementById('closeModal');
        const searchInput = document.getElementById('searchInput');
        const filterBtns = document.querySelectorAll('.filter-btn');
        const cards = document.querySelectorAll('.facility-card');

        // 1. Force Search Function
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const term = this.value.toLowerCase();
                document.querySelectorAll('.facility-card').forEach(card => {
                    const name = card.getAttribute('data-name').toLowerCase();
                    card.style.setProperty('display', name.includes(term) ? 'block' : 'none', 'important');
                });
            });
        }

        // 2. Force Filter Buttons
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const type = this.getAttribute('data-type');
                cards.forEach(card => {
                    if (type === 'all' || card.classList.contains(type)) {
                        card.style.setProperty('display', 'block', 'important');
                    } else {
                        card.style.setProperty('display', 'none', 'important');
                    }
                });
            });
        });

        // 3. Force Book Button & Blur Pop-up
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('book-btn')) {
                const card = e.target.closest('.facility-card');
                const roomName = card.querySelector('h3').innerText;
                
                document.getElementById('displayRoomName').innerText = roomName;
                document.getElementById('inputRoomName').value = roomName;
                
                // Use inline style to force display
                overlay.style.setProperty('display', 'flex', 'important');
            }
        });

        // 4. Close Pop-up
        if (closeBtn) {
            closeBtn.onclick = function() {
                overlay.style.setProperty('display', 'none', 'important');
            };
        }
    });
</script>