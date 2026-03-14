
        $(document).ready(function() {
            let currentGrade = 5;
            let currentGame = '';
            let score = 0;
            let streak = 0;
            let level = 1;
            let currentQuestion = null;
            let questionsAnswered = 0;
            const questionsPerLevel = 5;

            const gameModes = {
                5: [
                    { id: 'simplify', icon: '✂️', title: 'Sadeleştirme', desc: 'Kesirleri en sade haline getir', diff: 'easy' },
                    { id: 'expand', icon: '📏', title: 'Genişletme', desc: 'Pay ve paydayı aynı sayıyla çarp', diff: 'easy' },
                    { id: 'add_simple', icon: '➕', title: 'Toplama (Basit)', desc: 'Aynı paydalı kesirleri topla', diff: 'easy' },
                    { id: 'subtract_simple', icon: '➖', title: 'Çıkarma (Basit)', desc: 'Aynı paydalı kesirleri çıkar', diff: 'medium' },
                    { id: 'to_improper', icon: '🔄', title: 'Bileşik Kesir', desc: 'Tam sayılı kesri bileşik kesre çevir', diff: 'medium' },
                    { id: 'to_mixed', icon: '🔄', title: 'Tam Sayılı Kesir', desc: 'Bileşik kesri tam sayılı kesre çevir', diff: 'medium' }
                ],
                6: [
                    { id: 'add_diff', icon: '➕', title: 'Toplama', desc: 'Farklı paydalı kesirleri topla', diff: 'medium' },
                    { id: 'subtract_diff', icon: '➖', title: 'Çıkarma', desc: 'Farklı paydalı kesirleri çıkar', diff: 'medium' },
                    { id: 'multiply', icon: '✖️', title: 'Çarpma', desc: 'Kesirleri çarp (Sadeleştirme hatırlatmalı)', diff: 'medium' },
                    { id: 'divide', icon: '➗', title: 'Bölme', desc: 'Kesirleri bölebilir misin?', diff: 'hard' },
                    { id: 'compare', icon: '⚖️', title: 'Karşılaştırma', desc: 'Hangi kesir daha büyük?', diff: 'medium' },
                    { id: 'order', icon: '📊', title: 'Sıralama', desc: 'Kesirleri küçükten büyüğe sırala', diff: 'hard' }
                ],
                7: [
                    { id: 'complex_add', icon: '➕', title: 'Karmaşık Toplama', desc: 'Tam sayılı ve bileşik kesirleri topla', diff: 'medium' },
                    { id: 'complex_sub', icon: '➖', title: 'Karmaşık Çıkarma', desc: 'Tam sayılı ve bileşik kesirleri çıkar', diff: 'hard' },
                    { id: 'complex_multiply', icon: '✖️', title: 'Çarpma Uzmanı', desc: 'Sadeleştirerek çarp (Tüyoları kullan)', diff: 'hard' },
                    { id: 'complex_divide', icon: '➗', title: 'Bölme Uzmanı', desc: 'Tam sayılı kesirleri böl', diff: 'hard' },
                    { id: 'multi_step', icon: '🧮', title: 'Çok Adımlı', desc: 'Birden fazla işlem içeren problemler', diff: 'hard' },
                    { id: 'decimal_convert', icon: '🔄', title: 'Ondalık Dönüşüm', desc: 'Kesirleri ondalık sayılara çevir', diff: 'medium' }
                ]
            };

            $('.grade-btn').click(function() {
                $('.grade-btn').removeClass('active');
                $(this).addClass('active');
                currentGrade = parseInt($(this).data('grade'));
                renderMenu();
            });

            function renderMenu() {
                const grid = $('#menuGrid');
                grid.empty();
                
                gameModes[currentGrade].forEach(game => {
                    const diffClass = game.diff === 'easy' ? 'tag-easy' : game.diff === 'medium' ? 'tag-medium' : 'tag-hard';
                    const diffText = game.diff === 'easy' ? 'Kolay' : game.diff === 'medium' ? 'Orta' : 'Zor';
                    
                    const card = $(`
                        <div class="game-card" data-game="${game.id}">
                            <span class="game-icon">${game.icon}</span>
                            <div class="game-title">${game.title}</div>
                            <div class="game-desc">${game.desc}</div>
                            <span class="difficulty-tag ${diffClass}">${diffText}</span>
                        </div>
                    `);
                    grid.append(card);
                });

                $('.game-card').click(function() {
                    currentGame = $(this).data('game');
                    startGame();
                });
            }

            function startGame() {
                $('#mainMenu').hide();
                $('#gameArea').show();
                
                const gameInfo = gameModes[currentGrade].find(g => g.id === currentGame);
                $('#gameTitle').text(`${gameInfo.icon} ${gameInfo.title}`);
                
                score = 0;
                streak = 0;
                level = 1;
                questionsAnswered = 0;
                updateStats();
                generateQuestion();
            }

            function updateStats() {
                $('#score').text(score);
                $('#streak').text(streak);
                $('#level').text(level);
                $('#progressBar').css('width', (questionsAnswered / questionsPerLevel * 100) + '%');
            }

            function gcd(a, b) {
                a = Math.abs(a);
                b = Math.abs(b);
                return b === 0 ? a : gcd(b, a % b);
            }

            function lcm(a, b) {
                return Math.abs(a * b) / gcd(a, b);
            }

            function simplifyFraction(num, den) {
                if (num === 0) return { num: 0, den: 1 };
                const common = gcd(num, den);
                return { num: num / common, den: den / common };
            }

            function generateQuestion() {
                $('#hintsPanel').hide();
                $('#stepByStep').hide();
                $('#resultMessage').hide();
                $('#wholePart').val('');
                $('#numerator').val('');
                $('#denominator').val('');
                $('#fractionDisplay').empty();
                $('#visualFraction').empty();

                let question = {};
                let num1, num2, den1, den2, whole1, whole2;

                switch(currentGame) {
                    case 'simplify':
                        let mult = Math.floor(Math.random() * 4) + 2;
                        let simpleNum = Math.floor(Math.random() * 8) + 1;
                        let simpleDen = Math.floor(Math.random() * 8) + 2;
                        
                        while (gcd(simpleNum, simpleDen) > 1) {
                            simpleDen = Math.floor(Math.random() * 8) + 2;
                        }
                        
                        question = {
                            type: 'Sadeleştirme',
                            num: simpleNum * mult,
                            den: simpleDen * mult,
                            answer: { num: simpleNum, den: simpleDen, whole: 0 },
                            hint: `Pay ve paydayı ${mult} ile bölebilirsin!`,
                            steps: [
                                `${simpleNum * mult} ve ${simpleDen * mult} sayılarının EBOB'unu bul.`,
                                `EBOB(${simpleNum * mult}, ${simpleDen * mult}) = ${mult}`,
                                `Pay ve paydayı ${mult}'e böl: ${simpleNum}/${simpleDen}`
                            ]
                        };
                        break;

                    case 'expand':
                        let baseNum = Math.floor(Math.random() * 5) + 1;
                        let baseDen = Math.floor(Math.random() * 5) + 2;
                        let expandBy = Math.floor(Math.random() * 3) + 2;
                        
                        question = {
                            type: 'Genişletme',
                            num: baseNum,
                            den: baseDen,
                            answer: { num: baseNum * expandBy, den: baseDen * expandBy, whole: 0 },
                            hint: `Pay ve paydayı ${expandBy} ile çarp!`,
                            steps: [
                                `Payı ${expandBy} ile çarp: ${baseNum} × ${expandBy} = ${baseNum * expandBy}`,
                                `Paydayı ${expandBy} ile çarp: ${baseDen} × ${expandBy} = ${baseDen * expandBy}`,
                                `Sonuç: ${baseNum * expandBy}/${baseDen * expandBy}`
                            ]
                        };
                        break;

                    case 'add_simple':
                        let commonDen = Math.floor(Math.random() * 8) + 2;
                        let n1 = Math.floor(Math.random() * 5) + 1;
                        let n2 = Math.floor(Math.random() * 5) + 1;
                        
                        question = {
                            type: 'Toplama',
                            fractions: [{ num: n1, den: commonDen }, { num: n2, den: commonDen }],
                            operator: '+',
                            answer: simplifyFraction(n1 + n2, commonDen),
                            hint: 'Paydalar aynı, payları topla!',
                            steps: [
                                `Paydalar zaten eşit: ${commonDen}`,
                                `Payları topla: ${n1} + ${n2} = ${n1 + n2}`,
                                `Sonucu sadeleştir: ${simplifyFraction(n1 + n2, commonDen).num}/${simplifyFraction(n1 + n2, commonDen).den}`
                            ]
                        };
                        break;

                    case 'subtract_simple':
                        let subDen = Math.floor(Math.random() * 8) + 2;
                        let subNum1 = Math.floor(Math.random() * 6) + 3;
                        let subNum2 = Math.floor(Math.random() * (subNum1 - 1)) + 1;
                        
                        question = {
                            type: 'Çıkarma',
                            fractions: [{ num: subNum1, den: subDen }, { num: subNum2, den: subDen }],
                            operator: '-',
                            answer: simplifyFraction(subNum1 - subNum2, subDen),
                            hint: 'Paydalar aynı, payları çıkar!',
                            steps: [
                                `Paydalar zaten eşit: ${subDen}`,
                                `Payları çıkar: ${subNum1} - ${subNum2} = ${subNum1 - subNum2}`,
                                `Sonucu sadeleştir: ${simplifyFraction(subNum1 - subNum2, subDen).num}/${simplifyFraction(subNum1 - subNum2, subDen).den}`
                            ]
                        };
                        break;

                    case 'to_improper':
                        let whole = Math.floor(Math.random() * 5) + 1;
                        let impNum = Math.floor(Math.random() * 4) + 1;
                        let impDen = Math.floor(Math.random() * 4) + 2;

                        let rawNum = whole * impDen + impNum;
                        let simplifiedAns = simplifyFraction(rawNum, impDen);
                        
                        question = {
                            type: 'Dönüşüm',
                            mixed: { whole, num: impNum, den: impDen },
                            answer: { 
                                num: simplifiedAns.num,  // Sadeleştirilmiş pay
                                den: simplifiedAns.den,  // Sadeleştirilmiş payda
                                whole: 0 
                            },
                            hint: 'Tam sayıyı payda ile çarp, payı ekle!',
                            steps: [
                                `Tam sayıyı payda ile çarp: ${whole} × ${impDen} = ${whole * impDen}`,
                                `Payı ekle: ${whole * impDen} + ${impNum} = ${whole * impDen + impNum}`,
                                `Sonuç: ${whole * impDen + impNum}/${impDen}`
                            ]
                        };
                        break;

                    case 'to_mixed':
                        let mixNum = Math.floor(Math.random() * 15) + 10;
                        let mixDen = Math.floor(Math.random() * 5) + 2;
                        
                        while (mixNum % mixDen === 0) {
                            mixNum = Math.floor(Math.random() * 15) + 10;
                        }
                        
                        let mixedWhole = Math.floor(mixNum / mixDen);
                        let mixedRem = mixNum % mixDen;
                        let simplified = simplifyFraction(mixedRem, mixDen);
                        
                        question = {
                            type: 'Dönüşüm',
                            num: mixNum,
                            den: mixDen,
                            answer: { num: simplified.num, den: simplified.den, whole: mixedWhole },
                            hint: 'Payı paydaya böl, bölüm tam kısım, kalan pay olur!',
                            steps: [
                                `Payı paydaya böl: ${mixNum} ÷ ${mixDen}`,
                                `Bölüm: ${mixedWhole} (tam kısım)`,
                                `Kalan: ${mixedRem} (yeni pay)`,
                                `Sonuç: ${mixedWhole} ${simplified.num}/${simplified.den}`
                            ]
                        };
                        break;

                    case 'add_diff':
                        let d1 = Math.floor(Math.random() * 6) + 2;
                        let d2 = Math.floor(Math.random() * 6) + 2;
                        while (d1 === d2) d2 = Math.floor(Math.random() * 6) + 2;
                        
                        let addN1 = Math.floor(Math.random() * 4) + 1;
                        let addN2 = Math.floor(Math.random() * 4) + 1;
                        
                        let commonDenAdd = lcm(d1, d2);
                        let newNum1 = addN1 * (commonDenAdd / d1);
                        let newNum2 = addN2 * (commonDenAdd / d2);
                        
                        question = {
                            type: 'Toplama',
                            fractions: [{ num: addN1, den: d1 }, { num: addN2, den: d2 }],
                            operator: '+',
                            answer: simplifyFraction(newNum1 + newNum2, commonDenAdd),
                            hint: `EKOK(${d1}, ${d2}) = ${commonDenAdd} bul, genişlet!`,
                            steps: [
                                `EKOK(${d1}, ${d2}) = ${commonDenAdd}`,
                                `1. kesri ${commonDenAdd/d1} ile genişlet: ${addN1}/${d1} = ${newNum1}/${commonDenAdd}`,
                                `2. kesri ${commonDenAdd/d2} ile genişlet: ${addN2}/${d2} = ${newNum2}/${commonDenAdd}`,
                                `Payları topla: ${newNum1} + ${newNum2} = ${newNum1 + newNum2}`,
                                `Sonuç: ${simplifyFraction(newNum1 + newNum2, commonDenAdd).num}/${simplifyFraction(newNum1 + newNum2, commonDenAdd).den}`
                            ]
                        };
                        break;

                    case 'subtract_diff':
                        let sd1 = Math.floor(Math.random() * 6) + 2;
                        let sd2 = Math.floor(Math.random() * 6) + 2;
                        while (sd1 === sd2) sd2 = Math.floor(Math.random() * 6) + 2;
                        
                        let sn1 = Math.floor(Math.random() * 6) + 3;
                        let sn2 = Math.floor(Math.random() * 3) + 1;
                        
                        let commonDenSub = lcm(sd1, sd2);
                        let newSn1 = sn1 * (commonDenSub / sd1);
                        let newSn2 = sn2 * (commonDenSub / sd2);
                        
                        while (newSn1 <= newSn2) {
                            sn1 = Math.floor(Math.random() * 6) + 5;
                            newSn1 = sn1 * (commonDenSub / sd1);
                        }
                        
                        question = {
                            type: 'Çıkarma',
                            fractions: [{ num: sn1, den: sd1 }, { num: sn2, den: sd2 }],
                            operator: '-',
                            answer: simplifyFraction(newSn1 - newSn2, commonDenSub),
                            hint: `EKOK(${sd1}, ${sd2}) = ${commonDenSub} bul, genişlet!`,
                            steps: [
                                `EKOK(${sd1}, ${sd2}) = ${commonDenSub}`,
                                `1. kesri ${commonDenSub/sd1} ile genişlet: ${sn1}/${sd1} = ${newSn1}/${commonDenSub}`,
                                `2. kesri ${commonDenSub/sd2} ile genişlet: ${sn2}/${sd2} = ${newSn2}/${commonDenSub}`,
                                `Payları çıkar: ${newSn1} - ${newSn2} = ${newSn1 - newSn2}`,
                                `Sonuç: ${simplifyFraction(newSn1 - newSn2, commonDenSub).num}/${simplifyFraction(newSn1 - newSn2, commonDenSub).den}`
                            ]
                        };
                        break;

                    case 'multiply':
                        let mn1 = Math.floor(Math.random() * 6) + 2;
                        let md1 = Math.floor(Math.random() * 4) + 3;
                        let mn2 = Math.floor(Math.random() * 4) + 2;
                        let md2 = Math.floor(Math.random() * 4) + 3;
                        
                        if (Math.random() > 0.5) {
                            let common = Math.floor(Math.random() * 3) + 2;
                            mn1 *= common;
                            md2 *= common;
                        }
                        
                        let multResult = simplifyFraction(mn1 * mn2, md1 * md2);
                        
                        question = {
                            type: 'Çarpma',
                            fractions: [{ num: mn1, den: md1 }, { num: mn2, den: md2 }],
                            operator: '×',
                            answer: multResult,
                            hint: 'Önce sadeleştir, sonra çarp! (Çapraz sadeleştirme)',
                            steps: [
                                `Çapraz sadeleştirme yap: ${mn1} ve ${md2}, ${mn2} ve ${md1}`,
                                `Payları çarp: ${mn1} × ${mn2} = ${mn1 * mn2}`,
                                `Paydaları çarp: ${md1} × ${md2} = ${md1 * md2}`,
                                `Sonucu sadeleştir: ${multResult.num}/${multResult.den}`
                            ]
                        };
                        break;

                    case 'divide':
                        let divn1 = Math.floor(Math.random() * 6) + 2;
                        let divd1 = Math.floor(Math.random() * 4) + 2;
                        let divn2 = Math.floor(Math.random() * 4) + 2;
                        let divd2 = Math.floor(Math.random() * 4) + 2;
                        
                        let divResult = simplifyFraction(divn1 * divd2, divd1 * divn2);
                        
                        question = {
                            type: 'Bölme',
                            fractions: [{ num: divn1, den: divd1 }, { num: divn2, den: divd2 }],
                            operator: '÷',
                            answer: divResult,
                            hint: 'İkinci kesri ters çevir, çarpma yap!',
                            steps: [
                                `İkinci kesri ters çevir: ${divn2}/${divd2} → ${divd2}/${divn2}`,
                                `Payları çarp: ${divn1} × ${divd2} = ${divn1 * divd2}`,
                                `Paydaları çarp: ${divd1} × ${divn2} = ${divd1 * divn2}`,
                                `Sonucu sadeleştir: ${divResult.num}/${divResult.den}`
                            ]
                        };
                        break;

                    case 'compare':
                        let cd1 = Math.floor(Math.random() * 8) + 2;
                        let cd2 = Math.floor(Math.random() * 8) + 2;
                        let cn1 = Math.floor(Math.random() * 6) + 1;
                        let cn2 = Math.floor(Math.random() * 6) + 1;
                        
                        // Farklı değerler olsun
                        while (cn1 * cd2 === cn2 * cd1) {
                            cn2 = Math.floor(Math.random() * 6) + 1;
                        }
                        
                        let isGreater = (cn1 * cd2) > (cn2 * cd1);
                        
                        question = {
                            type: 'Karşılaştırma',
                            fractions: [{ num: cn1, den: cd1 }, { num: cn2, den: cd2 }],
                            operator: isGreater ? '>' : '<',
                            isComparison: true,
                            answer: { num: isGreater ? 1 : 0, den: 1, whole: 0 }, // 1 = ilk büyük, 0 = ikinci büyük
                            hint: 'Çapraz çarpım yap: İlk pay × İkinci payda vs İkinci pay × İlk payda',
                            steps: [
                                `Çapraz çarpım: ${cn1} × ${cd2} = ${cn1 * cd2} vs ${cn2} × ${cd1} = ${cn2 * cd1}`,
                                `${cn1 * cd2} ${isGreater ? '>' : '<'} ${cn2 * cd1}`,
                                `Sonuç: ${cn1}/${cd1} ${isGreater ? '>' : '<'} ${cn2}/${cd2}`
                            ]
                        };
                        break;

                    case 'order':
                        let count = 3;
                        let orderFracs = [];
                        for (let i = 0; i < count; i++) {
                            orderFracs.push({
                                num: Math.floor(Math.random() * 6) + 1,
                                den: Math.floor(Math.random() * 6) + 2
                            });
                        }
                        
                        // Değerlerine göre sırala
                        let sorted = [...orderFracs].sort((a, b) => (a.num * b.den) - (b.num * a.den));
                        
                        question = {
                            type: 'Sıralama',
                            fractions: orderFracs,
                            isOrdering: true,
                            answer: sorted,
                            hint: 'Hepsini aynı paydaya getir veya çapraz çarpım yaparak karşılaştır!',
                            steps: sorted.map((f, i) => `${i+1}. ${f.num}/${f.den} = ${(f.num/f.den).toFixed(3)}`)
                        };
                        break;

                    // 7. SINIF MODÜLLERİ - DÜZELTİLMİŞ
                    case 'complex_add':
                        // Tam sayılı kesir toplama
                        whole1 = Math.floor(Math.random() * 3) + 1;
                        whole2 = Math.floor(Math.random() * 3) + 1;
                        num1 = Math.floor(Math.random() * 5) + 1;
                        num2 = Math.floor(Math.random() * 5) + 1;
                        den1 = Math.floor(Math.random() * 4) + 2;
                        den2 = Math.floor(Math.random() * 4) + 2;
                        
                        // Bileşik kesirlere çevir
                        let totalNum1 = (whole1 * den1) + num1;
                        let totalNum2 = (whole2 * den2) + num2;
                        
                        let addCommonDen = lcm(den1, den2);
                        let addNewNum1 = totalNum1 * (addCommonDen / den1);
                        let addNewNum2 = totalNum2 * (addCommonDen / den2);
                        let sumNum = addNewNum1 + addNewNum2;
                        
                        let finalWhole = Math.floor(sumNum / addCommonDen);
                        let finalRem = sumNum % addCommonDen;
                        let finalSimple = simplifyFraction(finalRem, addCommonDen);
                        
                        question = {
                            type: 'Karmaşık Toplama',
                            mixedFractions: [
                                { whole: whole1, num: num1, den: den1 },
                                { whole: whole2, num: num2, den: den2 }
                            ],
                            operator: '+',
                            answer: { whole: finalWhole, num: finalSimple.num, den: finalSimple.den },
                            hint: `Tam sayıları topla, kesirleri EKOK(${den1}, ${den2}) = ${addCommonDen} ile genişleterek topla!`,
                            steps: [
                                `1. kesri bileşik kesre çevir: ${whole1} ${num1}/${den1} = ${totalNum1}/${den1}`,
                                `2. kesri bileşik kesre çevir: ${whole2} ${num2}/${den2} = ${totalNum2}/${den2}`,
                                `EKOK(${den1}, ${den2}) = ${addCommonDen}`,
                                `Genişlet: ${totalNum1}/${den1} = ${addNewNum1}/${addCommonDen}, ${totalNum2}/${den2} = ${addNewNum2}/${addCommonDen}`,
                                `Topla: ${addNewNum1} + ${addNewNum2} = ${sumNum}/${addCommonDen}`,
                                `Tam sayılıya çevir: ${finalWhole} ${finalSimple.num}/${finalSimple.den}`
                            ]
                        };
                        break;

                    case 'complex_sub':
                        // Tam sayılı kesir çıkarma (büyükten küçüğe)
                        whole1 = Math.floor(Math.random() * 5) + 3;
                        whole2 = Math.floor(Math.random() * 3) + 1;
                        num1 = Math.floor(Math.random() * 5) + 1;
                        num2 = Math.floor(Math.random() * 5) + 1;
                        den1 = Math.floor(Math.random() * 4) + 2;
                        den2 = Math.floor(Math.random() * 4) + 2;
                        
                        // Sonucun pozitif olmasını sağla
                        let total1 = whole1 + (num1/den1);
                        let total2 = whole2 + (num2/den2);
                        while (total1 <= total2) {
                            whole1 = Math.floor(Math.random() * 5) + 5;
                            total1 = whole1 + (num1/den1);
                        }
                        
                        let totalNumSub1 = (whole1 * den1) + num1;
                        let totalNumSub2 = (whole2 * den2) + num2;
                        
                        let subCommonDen = lcm(den1, den2);
                        let subNewNum1 = totalNumSub1 * (subCommonDen / den1);
                        let subNewNum2 = totalNumSub2 * (subCommonDen / den2);
                        let diffNum = subNewNum1 - subNewNum2;
                        
                        let subFinalWhole = Math.floor(diffNum / subCommonDen);
                        let subFinalRem = diffNum % subCommonDen;
                        let subFinalSimple = simplifyFraction(subFinalRem, subCommonDen);
                        
                        question = {
                            type: 'Karmaşık Çıkarma',
                            mixedFractions: [
                                { whole: whole1, num: num1, den: den1 },
                                { whole: whole2, num: num2, den: den2 }
                            ],
                            operator: '-',
                            answer: { whole: subFinalWhole, num: subFinalSimple.num, den: subFinalSimple.den },
                            hint: 'Tam sayılı kesirleri bileşik kesre çevir, sonra çıkar!',
                            steps: [
                                `1. kesri bileşik kesre çevir: ${whole1} ${num1}/${den1} = ${totalNumSub1}/${den1}`,
                                `2. kesri bileşik kesre çevir: ${whole2} ${num2}/${den2} = ${totalNumSub2}/${den2}`,
                                `EKOK(${den1}, ${den2}) = ${subCommonDen}`,
                                `Genişlet ve çıkar: ${subNewNum1} - ${subNewNum2} = ${diffNum}/${subCommonDen}`,
                                `Sonuç: ${subFinalWhole} ${subFinalSimple.num}/${subFinalSimple.den}`
                            ]
                        };
                        break;

                    case 'complex_multiply':
                        // Sadeleştirme tüyoları ile çarpma
                        num1 = Math.floor(Math.random() * 8) + 2;
                        den1 = Math.floor(Math.random() * 6) + 3;
                        num2 = Math.floor(Math.random() * 6) + 2;
                        den2 = Math.floor(Math.random() * 6) + 3;
                        
                        // Sadeleştirme şansı yarat
                        let common1 = gcd(num1, den2);
                        let common2 = gcd(num2, den1);
                        
                        if (common1 === 1 && common2 === 1) {
                            // En az bir ortak olsun
                            let factor = Math.floor(Math.random() * 3) + 2;
                            if (Math.random() > 0.5) {
                                num1 *= factor;
                                den2 *= factor;
                            } else {
                                num2 *= factor;
                                den1 *= factor;
                            }
                        }
                        
                        let simpNum1 = num1;
                        let simpDen2 = den2;
                        let simpNum2 = num2;
                        let simpDen1 = den1;
                        
                        let cancel1 = gcd(num1, den2);
                        let cancel2 = gcd(num2, den1);
                        
                        if (cancel1 > 1) {
                            simpNum1 = num1 / cancel1;
                            simpDen2 = den2 / cancel1;
                        }
                        if (cancel2 > 1) {
                            simpNum2 = num2 / cancel2;
                            simpDen1 = den1 / cancel2;
                        }
                        
                        let finalMultNum = simpNum1 * simpNum2;
                        let finalMultDen = simpDen1 * simpDen2;
                        let multSimplified = simplifyFraction(finalMultNum, finalMultDen);
                        
                        question = {
                            type: 'Çarpma Uzmanı',
                            fractions: [{ num: num1, den: den1 }, { num: num2, den: den2 }],
                            operator: '×',
                            answer: multSimplified,
                            hint: cancel1 > 1 || cancel2 > 1 ? `Çapraz sadeleştir: ${cancel1 > 1 ? num1+'/'+den2+' → '+simpNum1+'/'+simpDen2 : ''} ${cancel2 > 1 ? num2+'/'+den1+' → '+simpNum2+'/'+simpDen1 : ''}` : 'Çapraz sadeleştirme yapılabilir mi kontrol et!',
                            steps: [
                                cancel1 > 1 ? `${num1} ve ${den2} için EBOB = ${cancel1}, sadeleştir: ${simpNum1}/${simpDen2}` : 'Sadeleştirilecek çapraz yok',
                                cancel2 > 1 ? `${num2} ve ${den1} için EBOB = ${cancel2}, sadeleştir: ${simpNum2}/${simpDen1}` : 'Sadeleştirilecek çapraz yok',
                                `Kalan payları çarp: ${simpNum1} × ${simpNum2} = ${finalMultNum}`,
                                `Kalan paydaları çarp: ${simpDen1} × ${simpDen2} = ${finalMultDen}`,
                                `Sonucu sadeleştir: ${multSimplified.num}/${multSimplified.den}`
                            ]
                        };
                        break;

                    case 'complex_divide':
                        // Tam sayılı kesir bölme
                        whole1 = Math.floor(Math.random() * 3) + 1;
                        whole2 = Math.floor(Math.random() * 2) + 1;
                        num1 = Math.floor(Math.random() * 5) + 1;
                        num2 = Math.floor(Math.random() * 5) + 1;
                        den1 = Math.floor(Math.random() * 4) + 2;
                        den2 = Math.floor(Math.random() * 4) + 2;
                        
                        let divTotal1 = (whole1 * den1) + num1;
                        let divTotal2 = (whole2 * den2) + num2;
                        
                        // Bölme: ilk × ikincinin tersi
                        let divFinalNum = divTotal1 * den2;
                        let divFinalDen = den1 * divTotal2;
                        let divSimplified = simplifyFraction(divFinalNum, divFinalDen);
                        
                        let divFinalWhole = Math.floor(divSimplified.num / divSimplified.den);
                        let divFinalRem = divSimplified.num % divSimplified.den;
                        
                        question = {
                            type: 'Bölme Uzmanı',
                            mixedFractions: [
                                { whole: whole1, num: num1, den: den1 },
                                { whole: whole2, num: num2, den: den2 }
                            ],
                            operator: '÷',
                            answer: divFinalWhole > 0 ? { whole: divFinalWhole, num: divFinalRem, den: divSimplified.den } : { num: divSimplified.num, den: divSimplified.den, whole: 0 },
                            hint: 'Tam sayılı kesirleri bileşik kesre çevir, ikinciyi ters çevir, çarp!',
                            steps: [
                                `1. kesri bileşik kesre çevir: ${whole1} ${num1}/${den1} = ${divTotal1}/${den1}`,
                                `2. kesri bileşik kesre çevir: ${whole2} ${num2}/${den2} = ${divTotal2}/${den2}`,
                                `İkinci kesri ters çevir: ${divTotal2}/${den2} → ${den2}/${divTotal2}`,
                                `Çarp: ${divTotal1}/${den1} × ${den2}/${divTotal2} = ${divFinalNum}/${divFinalDen}`,
                                `Sadeleştir: ${divSimplified.num}/${divSimplified.den}`,
                                divFinalWhole > 0 ? `Tam sayılıya çevir: ${divFinalWhole} ${divFinalRem}/${divSimplified.den}` : ''
                            ].filter(s => s !== '')
                        };
                        break;

                    case 'multi_step':
                        // Parantezli veya öncelikli işlem
                        let stepType = Math.random() > 0.5 ? 'add_sub' : 'mult_div';
                        
                        if (stepType === 'add_sub') {
                            // (a/b + c/d) - e/f veya a/b + (c/d - e/f)
                            let s1 = Math.floor(Math.random() * 3) + 2;
                            let s2 = Math.floor(Math.random() * 3) + 2;
                            let s3 = Math.floor(Math.random() * 3) + 2;
                            let n1 = Math.floor(Math.random() * 3) + 1;
                            let n2 = Math.floor(Math.random() * 3) + 1;
                            let n3 = Math.floor(Math.random() * 3) + 1;
                            
                            let firstSum = simplifyFraction(n1 * s2 + n2 * s1, s1 * s2);
                            let finalResult = simplifyFraction(firstSum.num * s3 - n3 * firstSum.den, firstSum.den * s3);
                            
                            question = {
                                type: 'Çok Adımlı (Öncelik)',
                                expression: `(${n1}/${s1} + ${n2}/${s2}) - ${n3}/${s3}`,
                                answer: finalResult,
                                hint: 'Önce parantez içini çöz, sonra çıkarma yap!',
                                steps: [
                                    `Parantez içi: ${n1}/${s1} + ${n2}/${s2}`,
                                    `EKOK(${s1}, ${s2}) = ${lcm(s1, s2)}`,
                                    `Topla: ${n1 * (lcm(s1,s2)/s1) + n2 * (lcm(s1,s2)/s2)}/${lcm(s1,s2)} = ${firstSum.num}/${firstSum.den}`,
                                    `Çıkar: ${firstSum.num}/${firstSum.den} - ${n3}/${s3}`,
                                    `Sonuç: ${finalResult.num}/${finalResult.den}`
                                ]
                            };
                        } else {
                            // a/b × (c/d ÷ e/f)
                            let m1 = Math.floor(Math.random() * 3) + 2;
                            let m2 = Math.floor(Math.random() * 3) + 2;
                            let m3 = Math.floor(Math.random() * 3) + 2;
                            let mn1 = Math.floor(Math.random() * 3) + 1;
                            let mn2 = Math.floor(Math.random() * 3) + 1;
                            let mn3 = Math.floor(Math.random() * 3) + 1;
                            
                            let innerDiv = simplifyFraction(mn2 * m3, m2 * mn3);
                            let finalMult = simplifyFraction(mn1 * innerDiv.num, m1 * innerDiv.den);
                            
                            question = {
                                type: 'Çok Adımlı (Öncelik)',
                                expression: `${mn1}/${m1} × (${mn2}/${m2} ÷ ${mn3}/${m3})`,
                                answer: finalMult,
                                hint: 'Önce parantez içindeki bölme işlemini yap!',
                                steps: [
                                    `Parantez içi bölme: ${mn2}/${m2} ÷ ${mn3}/${m3}`,
                                    `Ters çevir ve çarp: ${mn2}/${m2} × ${m3}/${mn3} = ${innerDiv.num}/${innerDiv.den}`,
                                    `Sonra çarp: ${mn1}/${m1} × ${innerDiv.num}/${innerDiv.den}`,
                                    `Sonuç: ${finalMult.num}/${finalMult.den}`
                                ]
                            };
                        }
                        break;

                    case 'decimal_convert':
                        // Kesri ondalık sayıya çevirme
                        let decDen = [2, 4, 5, 8, 10, 20, 25, 50, 100][Math.floor(Math.random() * 9)];
                        let decNum = Math.floor(Math.random() * (decDen - 1)) + 1;
                        
                        // Sadeleştir
                        let decSimple = simplifyFraction(decNum, decDen);
                        let decimal = (decSimple.num / decSimple.den).toFixed(2);
                        
                        question = {
                            type: 'Ondalık Dönüşüm',
                            num: decSimple.num,
                            den: decSimple.den,
                            isDecimal: true,
                            answer: { num: parseInt(decimal * 100), den: 100, whole: 0, decimal: decimal }, // 0.25 = 25/100
                            hint: `Payı paydaya böl: ${decSimple.num} ÷ ${decSimple.den}`,
                            steps: [
                                `${decSimple.num}/${decSimple.den} kesrinde payı paydaya böl`,
                                `${decSimple.num} ÷ ${decSimple.den} = ${decimal}`,
                                `Ondalık gösterim: ${decimal}`
                            ]
                        };
                        break;

                    default:
                        question = {
                            type: 'Toplama',
                            num: 1,
                            den: 2,
                            answer: { num: 1, den: 2, whole: 0 },
                            hint: 'Varsayılan soru',
                            steps: ['Adım 1', 'Adım 2']
                        };
                }

                currentQuestion = question;
                displayQuestion(question);
            }

            function displayQuestion(q) {
                $('#questionType').text(q.type);
                let html = '';

                if (q.isComparison) {
                    html = `
                        <div class="fraction">
                            <span class="fraction-top">${q.fractions[0].num}</span>
                            <span class="fraction-bottom">${q.fractions[0].den}</span>
                        </div>
                        <span class="operator">?</span>
                        <div class="fraction">
                            <span class="fraction-top">${q.fractions[1].num}</span>
                            <span class="fraction-bottom">${q.fractions[1].den}</span>
                        </div>
                        <div style="width: 100%; margin-top: 20px; font-size: 1.2rem; color: #718096;">
                            Hangisi büyük? İlk kesir büyükse "1", ikinci kesir büyükse "0" yazın.
                        </div>
                    `;
                    // Sadece pay girişi aktif olsun
                    $('#wholePart').hide();
                    $('#denominator').hide();
                    $('.input-line').hide();
                    $('#numerator').attr('placeholder', '1 veya 0');
                } else if (q.isOrdering) {
                    html = `<div style="display: flex; gap: 20px; flex-wrap: wrap; justify-content: center;">`;
                    q.fractions.forEach((f, i) => {
                        html += `
                            <div class="fraction">
                                <span class="fraction-top">${f.num}</span>
                                <span class="fraction-bottom">${f.den}</span>
                            </div>
                        `;
                    });
                    html += `</div><div style="margin-top: 20px; color: #718096;">Küçükten büyüğe sıralayın (örnek: 1/2, 1/3, 2/3)</div>`;
                } else if (q.mixed) {
                    html = `
                        <div class="mixed-display">
                            <span class="whole-number">${q.mixed.whole}</span>
                            <div class="fraction">
                                <span class="fraction-top">${q.mixed.num}</span>
                                <span class="fraction-bottom">${q.mixed.den}</span>
                            </div>
                        </div>
                        <span class="equals">=</span>
                        <span style="font-size: 3rem;">?</span>
                    `;
                } else if (q.mixedFractions) {
                    html = `
                        <div class="mixed-display">
                            <span class="whole-number">${q.mixedFractions[0].whole}</span>
                            <div class="fraction">
                                <span class="fraction-top">${q.mixedFractions[0].num}</span>
                                <span class="fraction-bottom">${q.mixedFractions[0].den}</span>
                            </div>
                        </div>
                        <span class="operator">${q.operator}</span>
                        <div class="mixed-display">
                            <span class="whole-number">${q.mixedFractions[1].whole}</span>
                            <div class="fraction">
                                <span class="fraction-top">${q.mixedFractions[1].num}</span>
                                <span class="fraction-bottom">${q.mixedFractions[1].den}</span>
                            </div>
                        </div>
                        <span class="equals">=</span>
                        <span style="font-size: 3rem;">?</span>
                    `;
                } else if (q.fractions) {
                    html = `
                        <div class="fraction">
                            <span class="fraction-top">${q.fractions[0].num}</span>
                            <span class="fraction-bottom">${q.fractions[0].den}</span>
                        </div>
                        <span class="operator">${q.operator}</span>
                        <div class="fraction">
                            <span class="fraction-top">${q.fractions[1].num}</span>
                            <span class="fraction-bottom">${q.fractions[1].den}</span>
                        </div>
                        <span class="equals">=</span>
                        <span style="font-size: 3rem;">?</span>
                    `;
                } else if (q.expression) {
                    html = `
                        <div style="font-size: 2rem; font-weight: bold; color: #2d3748;">
                            ${q.expression} = ?
                        </div>
                    `;
                } else {
                    html = `
                        <div class="fraction">
                            <span class="fraction-top">${q.num}</span>
                            <span class="fraction-bottom">${q.den}</span>
                        </div>
                        <span class="equals">=</span>
                        <span style="font-size: 3rem;">?</span>
                    `;
                }

                $('#fractionDisplay').html(html);
            }

            $('#checkBtn').click(function() {
                const whole = parseInt($('#wholePart').val()) || 0;
                const num = parseInt($('#numerator').val());
                const den = parseInt($('#denominator').val());

                if (currentQuestion.isComparison) {
                    // Karşılaştırma sorusu
                    if (isNaN(num) || (num !== 0 && num !== 1)) {
                        showResult('Lütfen 0 (ikinci büyük) veya 1 (ilk büyük) girin!', false);
                        return;
                    }
                    
                    const isCorrect = num === currentQuestion.answer.num;
                    if (isCorrect) {
                        handleCorrect();
                        showResult('🎉 Doğru! Harika karşılaştırma!', true);
                    } else {
                        handleWrong();
                        showResult(`❌ Yanlış! Doğru cevap: ${currentQuestion.answer.num === 1 ? 'İlk kesir büyük' : 'İkinci kesir büyük'}`, false);
                    }
                    return;
                }

                if (currentQuestion.isDecimal) {
                    // Ondalık dönüşüm kontrolü
                    let userVal = parseFloat($('#numerator').val() / $('#denominator').val());
                    let correctVal = parseFloat(currentQuestion.answer.decimal);
                    
                    if (Math.abs(userVal - correctVal) < 0.01 || 
                        (num === parseInt(currentQuestion.answer.decimal * 100) && den === 100)) {
                        handleCorrect();
                        showResult('🎉 Doğru! Kesir = ' + currentQuestion.answer.decimal, true);
                    } else {
                        handleWrong();
                        showResult(`❌ Yanlış! Doğru cevap: ${currentQuestion.answer.decimal}`, false);
                        showStepByStep();
                    }
                    return;
                }

                if (isNaN(num) || isNaN(den) || den === 0) {
                    showResult('Lütfen geçerli bir kesir girin! 🤔', false);
                    return;
                }

                let userAnswer;
                if (whole > 0) {
                    userAnswer = { num: whole * den + num, den: den, whole: 0 };
                } else {
                    userAnswer = simplifyFraction(num, den);
                }

                const correct = currentQuestion.answer;
                const isCorrect = (userAnswer.num === correct.num && userAnswer.den === correct.den) ||
                                  (whole === correct.whole && num === correct.num && den === correct.den && whole > 0) ||
                                  (whole === 0 && correct.whole === 0 && userAnswer.num === correct.num && userAnswer.den === correct.den);

                if (isCorrect) {
                    handleCorrect();
                    showResult('🎉 Harika! Doğru cevap!', true);
                    createConfetti();
                } else {
                    handleWrong();
                    let correctStr = correct.whole ? `${correct.whole} ${correct.num}/${correct.den}` : `${correct.num}/${correct.den}`;
                    showResult(`❌ Yanlış! Doğru cevap: ${correctStr}`, false);
                    showStepByStep();
                }
            });

            function handleCorrect() {
                score += 10 + (streak * 2);
                streak++;
                questionsAnswered++;
                updateStats();
                
                if (questionsAnswered >= questionsPerLevel) {
                    setTimeout(() => {
                        levelUp();
                    }, 1500);
                } else {
                    setTimeout(() => {
                        generateQuestion();
                    }, 2000);
                }
            }

            function handleWrong() {
                streak = 0;
                updateStats();
            }

            function showResult(msg, success) {
                const resultDiv = $('#resultMessage');
                resultDiv.removeClass('success error').addClass(success ? 'success' : 'error').html(msg).show();
                
                if (success) {
                    resultDiv.append('<div style="margin-top: 10px; font-size: 2rem;">⭐⭐⭐</div>');
                }
            }

            function levelUp() {
                level++;
                questionsAnswered = 0;
                $('#badgeContainer').append(`<span class="badge">🏆 Seviye ${level-1} Tamamlandı!</span>`);
                
                setTimeout(() => {
                    alert(`🎉 Tebrikler! Seviye ${level-1} tamamlandı!\nToplam Puan: ${score}\nYeni seviyeye geçiliyor...`);
                    generateQuestion();
                }, 500);
            }

            $('#helpBtn').click(function() {
                $('#hintsPanel').show();
                $('#hintsContent').html(`<div class="hint-item">${currentQuestion.hint}</div>`);
            });

            function showStepByStep() {
                $('#stepByStep').show();
                let stepsHtml = '';
                currentQuestion.steps.forEach((step, index) => {
                    if (step) {
                        stepsHtml += `
                            <div class="step" style="animation-delay: ${index * 0.2}s">
                                <div class="step-number">${index + 1}</div>
                                <div>${step}</div>
                            </div>
                        `;
                    }
                });
                $('#stepsContent').html(stepsHtml);
            }

            function createConfetti() {
                const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#ffeaa7', '#dfe6e9', '#fd79a8'];
                for (let i = 0; i < 30; i++) {
                    const confetti = $('<div class="confetti"></div>');
                    confetti.css({
                        left: Math.random() * 100 + '%',
                        background: colors[Math.floor(Math.random() * colors.length)],
                        animationDelay: Math.random() * 2 + 's'
                    });
                    $('body').append(confetti);
                    setTimeout(() => confetti.remove(), 3000);
                }
            }

            $('#backBtn').click(function() {
                $('#gameArea').hide();
                $('#mainMenu').show();
                $('#badgeContainer').empty();
                $('#wholePart').show();
                $('#denominator').show();
                $('.input-line').show();
                $('#numerator').attr('placeholder', 'Pay');
            });

            $('#denominator').keypress(function(e) {
                if (e.which === 13) $('#checkBtn').click();
            });

            renderMenu();
        });
   
        $(document).ready(function() {
            // Canvas Değişkenleri
            const canvas = document.getElementById('drawingCanvas');
            const ctx = canvas.getContext('2d');
            const container = $('#canvasContainer');
            
            let isDrawing = false;
            let currentColor = '#1a202c';
            let currentWidth = 5;
            let isEraser = false;
            let undoStack = [];
            let undoLimit = 20;

            // Canvas Boyutlandırma
            function resizeCanvas() {
                const width = container.width();
                const height = container.height();
                
                // Mevcut içeriği sakla
                const tempCanvas = document.createElement('canvas');
                const tempCtx = tempCanvas.getContext('2d');
                tempCanvas.width = canvas.width;
                tempCanvas.height = canvas.height;
                tempCtx.drawImage(canvas, 0, 0);
                
                // Yeni boyutları ayarla
                canvas.width = width;
                canvas.height = height;
                
                // İçeriği geri yükle (ortalayarak)
                ctx.drawImage(tempCanvas, 0, 0);
                
                // Ayarları geri yükle
                ctx.lineCap = 'round';
                ctx.lineJoin = 'round';
                ctx.strokeStyle = currentColor;
                ctx.lineWidth = currentWidth;
                
                $('#sizeIndicator').text(`${width} x ${height}`);
            }

            // İlk boyutlandırma ve pencere değişikliğinde
            resizeCanvas();
            $(window).resize(resizeCanvas);

            // Canvas Aç/Kapat
            $('#penToggle, #closePen').click(function() {
                $('#penModule').toggleClass('open');
                $('#penToggle').toggleClass('active');
                $('#contentArea').toggleClass('canvas-active');
                
                if ($('#penModule').hasClass('open')) {
                    setTimeout(resizeCanvas, 300); // Animasyon bitince resize
                }
            });

            // Renk Seçimi
            $('.color-btn').click(function() {
                $('.color-btn').removeClass('active');
                $(this).addClass('active');
                
                currentColor = $(this).data('color');
                isEraser = (currentColor === '#ffffff');
                
                ctx.strokeStyle = currentColor;
                
                // Silgi modu görseli
                if (isEraser) {
                    $('#drawingCanvas').css('cursor', 'cell');
                } else {
                    $('#drawingCanvas').css('cursor', 'crosshair');
                }
            });

            // Kalınlık Seçimi
            $('.thickness-btn').click(function() {
                $('.thickness-btn').removeClass('active');
                $(this).addClass('active');
                
                currentWidth = parseInt($(this).data('width'));
                ctx.lineWidth = currentWidth;
            });

            // Çizim Fonksiyonları
            function getPos(e) {
                const rect = canvas.getBoundingClientRect();
                const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                const clientY = e.touches ? e.touches[0].clientY : e.clientY;
                return {
                    x: clientX - rect.left,
                    y: clientY - rect.top
                };
            }

            function startDrawing(e) {
                isDrawing = true;
                const pos = getPos(e);
                
                ctx.beginPath();
                ctx.moveTo(pos.x, pos.y);
                
                // Nokta çizimi (tek tıklama için)
                ctx.lineTo(pos.x, pos.y);
                ctx.stroke();
                
                // Undo için kaydet
                saveState();
            }

            function draw(e) {
                if (!isDrawing) return;
                e.preventDefault();
                
                const pos = getPos(e);
                
                ctx.lineTo(pos.x, pos.y);
                ctx.stroke();
            }

            function stopDrawing() {
                if (isDrawing) {
                    isDrawing = false;
                    ctx.beginPath();
                }
            }

            // Mouse Events
            $(canvas).mousedown(startDrawing);
            $(canvas).mousemove(draw);
            $(canvas).mouseup(stopDrawing);
            $(canvas).mouseleave(stopDrawing);

            // Touch Events (Mobil desteği)
            $(canvas).on('touchstart', function(e) {
                e.preventDefault();
                startDrawing(e.originalEvent);
            });
            $(canvas).on('touchmove', function(e) {
                e.preventDefault();
                draw(e.originalEvent);
            });
            $(canvas).on('touchend', stopDrawing);

            // Undo Sistemi
            function saveState() {
                if (undoStack.length >= undoLimit) {
                    undoStack.shift();
                }
                undoStack.push(canvas.toDataURL());
                $('#undoBtn').prop('disabled', false);
            }

            $('#undoBtn').click(function() {
                if (undoStack.length > 0) {
                    const imgData = undoStack.pop();
                    const img = new Image();
                    img.src = imgData;
                    img.onload = function() {
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        ctx.drawImage(img, 0, 0);
                    };
                }
                
                if (undoStack.length === 0) {
                    $('#undoBtn').prop('disabled', true);
                }
            });

            // Temizle
            $('#clearBtn').click(function() {
                if (confirm('Tüm çizimler silinecek. Emin misiniz?')) {
                    saveState();
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                }
            });

            // İndir
            $('#downloadBtn').click(function() {
                const link = document.createElement('a');
                link.download = 'kesir-cozumum-' + new Date().getTime() + '.png';
                link.href = canvas.toDataURL();
                link.click();
            });

            // Klavye Kısayolları
            $(document).keydown(function(e) {
                // Ctrl+Z veya Cmd+Z (Undo)
                if ((e.ctrlKey || e.metaKey) && e.key === 'z') {
                    e.preventDefault();
                    $('#undoBtn').click();
                }
                
                // ESC (Kapat)
                if (e.key === 'Escape' && $('#penModule').hasClass('open')) {
                    $('#closePen').click();
                }
            });

            // Başlangıçta boş state kaydet
            saveState();
        });