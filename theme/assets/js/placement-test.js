/**
 * Placement Test Logic
 * Handled with Vanilla JS (ES2022) to avoid dependencies.
 */

document.addEventListener('DOMContentLoaded', () => {
	const dataElement = document.getElementById('placement-test-data');
	if (!dataElement) return;

	let testData;
	try {
		testData = JSON.parse(dataElement.textContent || dataElement.innerText);
	} catch (e) {
		console.error('Test data parse error', e);
		return;
	}

	const questions = testData.questions || [];
	const timeLimitMinutes = testData.timeLimit || 30;
	const levels = testData.levels || [];
	const i18n = testData.i18n || {
		finish: 'Дуусгах',
		next: 'Дараах',
		unknown: 'Тодорхойгүй',
		no_match: 'Таны оноонд таарах төвшин олдсонгүй.'
	};
	
	if (questions.length === 0) {
		console.log('No questions found.');
		const btn = document.getElementById('btn-start-test');
		if(btn) btn.disabled = true;
		return;
	}

	// Calculate max score
	let maxScore = 0;
	questions.forEach(q => {
		if(q.options && q.options.length > 0) {
			const maxQuestionScore = Math.max(...q.options.map(opt => parseFloat(opt.score) || 0));
			maxScore += maxQuestionScore;
		}
	});

	// UI Elements
	const screenStart = document.getElementById('test-start-screen');
	const screenActive = document.getElementById('test-active-screen');
	const screenResult = document.getElementById('test-result-screen');
	
	const btnStart = document.getElementById('btn-start-test');
	const btnNext = document.getElementById('btn-next-q');
	const qContainer = document.getElementById('question-container');
	const qNumDisplay = document.getElementById('current-q-num');
	
	const timeDisplay = document.getElementById('time-remaining');
	const progressBar = document.getElementById('test-progress-bar');
	
	// State
	let currentQIndex = 0;
	let currentScore = 0;
	let timeRemainingSec = timeLimitMinutes * 60;
	let timerInterval = null;

	// Start Test Event
	btnStart.addEventListener('click', () => {
		screenStart.classList.add('hidden');
		screenActive.classList.remove('hidden');
		screenActive.classList.add('flex');
		
		startTimer();
		renderQuestion();
		updateProgress();
	});

	// Next Question Event
	btnNext.addEventListener('click', () => {
		const selectedOpt = document.querySelector('input[name="pt_option"]:checked');
		if (!selectedOpt) return;

		const scoreVal = parseFloat(selectedOpt.value) || 0;
		currentScore += scoreVal;
		
		currentQIndex++;
		
		if (currentQIndex >= questions.length) {
			finishTest();
		} else {
			renderQuestion();
			updateProgress();
		}
	});

	function renderQuestion() {
		btnNext.disabled = true;
		btnNext.classList.add('opacity-50', 'cursor-not-allowed', 'bg-slate-200');
		btnNext.classList.remove('bg-secondary', 'text-white');
		
		if(currentQIndex === questions.length - 1) {
			btnNext.innerHTML = `${i18n.finish} <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>`;
		} else {
			btnNext.innerHTML = `${i18n.next} <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>`;
		}

		qNumDisplay.textContent = currentQIndex + 1;
		const q = questions[currentQIndex];
		
		let html = `
			<h3 class="text-xl md:text-2xl font-bold text-slate-900 mb-6 leading-relaxed">${q.title}</h3>
			<div class="flex flex-col gap-3">
		`;

		if (q.options && q.options.length > 0) {
			q.options.forEach((opt, idx) => {
				html += `
					<label class="relative flex items-center p-4 border border-slate-200 rounded-lg cursor-pointer hover:bg-slate-50 hover:border-primary/30 transition-all duration-200 group">
						<input type="radio" name="pt_option" value="${opt.score}" class="w-5 h-5 text-primary border-slate-300 focus:ring-primary peer pt-option-radio">
						<span class="ml-3 text-slate-700 text-lg peer-checked:font-bold peer-checked:text-primary transition-colors">${opt.label}</span>
						<div class="absolute inset-0 border-2 border-transparent peer-checked:border-primary rounded-lg pointer-events-none transition-colors"></div>
					</label>
				`;
			});
		}

		html += `</div>`;
		qContainer.innerHTML = html;

		// Attach events to radio buttons to enable 'Next'
		const radios = qContainer.querySelectorAll('.pt-option-radio');
		radios.forEach(radio => {
			radio.addEventListener('change', () => {
				btnNext.disabled = false;
				btnNext.classList.remove('opacity-50', 'cursor-not-allowed', 'bg-slate-200');
				btnNext.classList.add('bg-secondary', 'text-white');
			});
		});
	}

	function updateProgress() {
		const percent = (currentQIndex / questions.length) * 100;
		progressBar.style.width = `${percent}%`;
	}

	function startTimer() {
		updateTimeDisplay();
		timerInterval = setInterval(() => {
			timeRemainingSec--;
			if (timeRemainingSec <= 0) {
				clearInterval(timerInterval);
				finishTest();
			} else {
				updateTimeDisplay();
			}
		}, 1000);
	}

	function updateTimeDisplay() {
		const m = Math.floor(timeRemainingSec / 60).toString().padStart(2, '0');
		const s = (timeRemainingSec % 60).toString().padStart(2, '0');
		timeDisplay.textContent = `${m}:${s}`;
		
		// Warning color at 1 minute
		if (timeRemainingSec <= 60) {
			timeDisplay.parentElement.classList.remove('text-primary');
			timeDisplay.parentElement.classList.add('text-red-500', 'border-red-100');
		}
	}

	function finishTest() {
		clearInterval(timerInterval);
		progressBar.style.width = '100%';

		// Find matching level
		let matchedLevel = null;
		for (const lvl of levels) {
			const min = parseFloat(lvl.min_score) || 0;
			const max = parseFloat(lvl.max_score) || 99999;
			if (currentScore >= min && currentScore <= max) {
				matchedLevel = lvl;
				break;
			}
		}

		screenActive.classList.add('hidden');
		screenActive.classList.remove('flex');
		screenResult.classList.remove('hidden');

		document.getElementById('result-score').textContent = currentScore;
		document.getElementById('result-max-score').textContent = maxScore;

		const titleEl = document.getElementById('result-level-title');
		const descEl = document.getElementById('result-level-desc');
		const actionEl = document.getElementById('result-course-action');
		const linkEl = document.getElementById('result-course-link');

		if (matchedLevel) {
			titleEl.textContent = matchedLevel.title;
			if(matchedLevel.description) {
				descEl.innerHTML = matchedLevel.description.replace(/\n/g, '<br>');
			}
			if (matchedLevel.course_url) {
				actionEl.classList.remove('hidden');
				linkEl.href = matchedLevel.course_url;
			}
		} else {
			titleEl.textContent = i18n.unknown;
			descEl.textContent = i18n.no_match;
		}
	}
});
