// filepath: server.js
import dotenv from 'dotenv';
import express from 'express';
import sgMail from '@sendgrid/mail';
import { fileURLToPath } from 'url';
import { dirname, join } from 'path';

// ES Module equivalent of __dirname
const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

// Load environment variables
dotenv.config();

const app = express();

// Set SendGrid API Key
sgMail.setApiKey(process.env.SENDGRID_API_KEY);

// Middleware
app.use(express.json());
app.use(express.static(join(__dirname, 'public')));

// Endpoint untuk mengirim email manual
app.post('/kirim-email', async (req, res) => {
    try {
        console.log('📥 Request body:', JSON.stringify(req.body, null, 2));
        
        const { to, subject, text, html } = req.body;

        // Validasi input
        if (!to) {
            console.error('❌ Field "to" tidak ditemukan dalam request');
            return res.status(400).json({
                success: false,
                error: 'Email tujuan (to) wajib diisi',
                received: req.body
            });
        }

        if (!subject) {
            return res.status(400).json({
                success: false,
                error: 'Subject email wajib diisi'
            });
        }

        if (!text && !html) {
            return res.status(400).json({
                success: false,
                error: 'Content email (text atau html) wajib diisi'
            });
        }

        // Validasi API Key
        if (!process.env.SENDGRID_API_KEY) {
            throw new Error('SendGrid API Key tidak ditemukan');
        }

        // Validasi FROM_EMAIL
        if (!process.env.FROM_EMAIL) {
            throw new Error('FROM_EMAIL tidak ditemukan di .env');
        }

        // Format pesan untuk SendGrid
        const msg = {
            to: {
                email: to,
                name: req.body.toName || 'User'
            },
            from: {
                email: process.env.FROM_EMAIL,
                name: process.env.FROM_NAME || 'Golden Age Platform'
            },
            subject: subject,
            text: text || '',
            html: html || `<p>${text}</p>`
        };

        console.log('📤 Sending email...');
        console.log('  To:', msg.to.email);
        console.log('  From:', msg.from.email);
        console.log('  Subject:', msg.subject);

        // Kirim email via SendGrid
        const response = await sgMail.send(msg);
        
        console.log('✅ Email berhasil dikirim!');
        console.log('  Status:', response[0].statusCode);
        
        res.status(200).json({ 
            success: true, 
            message: 'Email berhasil dikirim',
            recipient: to,
            subject: subject,
            statusCode: response[0].statusCode
        });

    } catch (error) {
        console.error('❌ Error mengirim email:', error);
        
        // Detail error dari SendGrid
        if (error.response) {
            console.error('📛 SendGrid Error Response:', JSON.stringify(error.response.body, null, 2));
            res.status(error.code || 500).json({ 
                success: false, 
                error: error.response.body.errors?.[0]?.message || error.message,
                details: error.response.body,
                field: error.response.body.errors?.[0]?.field
            });
        } else {
            res.status(500).json({ 
                success: false, 
                error: error.message,
                stack: process.env.NODE_ENV === 'development' ? error.stack : undefined
            });
        }
    }
});

// Endpoint untuk mengirim email artikel
app.post('/kirim-email-artikel', async (req, res) => {
    try {
        console.log('📥 Artikel email request:', JSON.stringify(req.body, null, 2));
        
        const { to, userName, article } = req.body;

        // Validasi
        if (!to || !userName || !article) {
            return res.status(400).json({
                success: false,
                error: 'Missing required fields: to, userName, article'
            });
        }

        if (!process.env.SENDGRID_API_KEY) {
            throw new Error('SendGrid API Key tidak ditemukan');
        }

        const msg = {
            to: {
                email: to,
                name: userName
            },
            from: {
                email: process.env.FROM_EMAIL || 'noreply@goldenage.com',
                name: process.env.FROM_NAME || 'Golden Age Platform'
            },
            subject: `📖 Artikel Baru: ${article.title}`,
            html: generateArticleEmailTemplate(userName, article)
        };

        console.log('📤 Sending article email to:', to);

        await sgMail.send(msg);
        
        console.log(`✅ Article email sent successfully to ${to}`);
        
        res.status(200).json({ 
            success: true, 
            message: 'Email artikel berhasil dikirim',
            recipient: to
        });

    } catch (error) {
        console.error('❌ Error sending article email:', error);
        
        if (error.response) {
            console.error('SendGrid Error:', error.response.body);
            res.status(500).json({ 
                success: false, 
                error: error.response.body.errors?.[0]?.message || error.message,
                details: error.response.body
            });
        } else {
            res.status(500).json({ 
                success: false, 
                error: error.message
            });
        }
    }
});

// Test endpoint
app.get('/test-config', (req, res) => {
    res.json({
        hasApiKey: !!process.env.SENDGRID_API_KEY,
        apiKeyPrefix: process.env.SENDGRID_API_KEY?.substring(0, 10) + '...',
        fromEmail: process.env.FROM_EMAIL,
        fromName: process.env.FROM_NAME,
        port: process.env.PORT || 3000,
        nodeEnv: process.env.NODE_ENV || 'development'
    });
});

// Function untuk generate HTML template
function generateArticleEmailTemplate(userName, article) {
    return `
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Artikel Baru - Golden Age</title>
    </head>
    <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f4f4; padding: 20px;">
            <tr>
                <td align="center">
                    <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
                        <!-- Header -->
                        <tr>
                            <td style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 20px; text-align: center;">
                                <h1 style="color: #ffffff; margin: 0; font-size: 32px;">🌟 Golden Age</h1>
                                <p style="color: #ffffff; margin: 10px 0 0 0; font-size: 16px;">Platform Tumbuh Kembang Anak</p>
                            </td>
                        </tr>
                        
                        <!-- Content -->
                        <tr>
                            <td style="padding: 40px 30px;">
                                <h2 style="color: #333; margin: 0 0 20px 0;">Halo ${userName}! 👋</h2>
                                
                                <p style="color: #666; font-size: 16px; line-height: 1.6; margin: 0 0 20px 0;">
                                    Ada artikel baru yang menarik untuk Anda:
                                </p>
                                
                                <div style="background: #f8f9fa; padding: 25px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #667eea;">
                                    <h3 style="color: #333; margin: 0 0 15px 0; font-size: 20px;">📖 ${article.title}</h3>
                                    <p style="color: #666; font-size: 15px; line-height: 1.6; margin: 0;">
                                        ${article.excerpt}
                                    </p>
                                </div>
                                
                                <div style="text-align: center; margin: 30px 0;">
                                    <a href="${article.url}" style="display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #ffffff; padding: 15px 40px; text-decoration: none; border-radius: 25px; font-weight: bold; font-size: 16px;">
                                        Baca Artikel Lengkap →
                                    </a>
                                </div>
                                
                                <p style="color: #666; font-size: 15px; line-height: 1.6; margin: 20px 0 0 0;">
                                    Jangan lewatkan informasi penting tentang tumbuh kembang anak Anda! 🌱
                                </p>
                            </td>
                        </tr>
                        
                        <!-- Footer -->
                        <tr>
                            <td style="background-color: #f8f9fa; padding: 30px; text-align: center; border-top: 1px solid #eee;">
                                <p style="color: #999; font-size: 13px; line-height: 1.6; margin: 0;">
                                    Email ini dikirim otomatis dari sistem Golden Age.<br>
                                    Jika Anda tidak ingin menerima email ini lagi, silakan hubungi administrator.
                                </p>
                                <p style="color: #999; font-size: 12px; margin: 15px 0 0 0;">
                                    © 2025 Golden Age Platform. All rights reserved.
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>
    `;
}

// Serve test page
app.get('/', (req, res) => {
    res.send(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Golden Age Email Service</title>
            <style>
                body { font-family: Arial; max-width: 800px; margin: 50px auto; padding: 20px; }
                .endpoint { background: #f4f4f4; padding: 15px; margin: 10px 0; border-radius: 5px; }
                code { background: #e0e0e0; padding: 2px 6px; border-radius: 3px; }
                h1 { color: #667eea; }
            </style>
        </head>
        <body>
            <h1>🚀 Golden Age Email Service</h1>
            <p>Service is running! Available endpoints:</p>
            
            <div class="endpoint">
                <strong>GET /test-config</strong><br>
                Test konfigurasi service
            </div>
            
            <div class="endpoint">
                <strong>POST /kirim-email</strong><br>
                Body: <code>{ "to": "email@example.com", "subject": "...", "text": "..." }</code>
            </div>
            
            <div class="endpoint">
                <strong>POST /kirim-email-artikel</strong><br>
                Body: <code>{ "to": "...", "userName": "...", "article": {...} }</code>
            </div>
        </body>
        </html>
    `);
});

const PORT = process.env.PORT || 3000;

const server = app.listen(PORT, () => {
    console.log(`🚀 Email service berjalan di http://localhost:${PORT}`);
    console.log(`📧 From Email: ${process.env.FROM_EMAIL}`);
    console.log(`🔑 API Key configured: ${!!process.env.SENDGRID_API_KEY}`);
    console.log(`\n📋 Test endpoints:`);
    console.log(`   GET  /test-config  - Test konfigurasi`);
    console.log(`   POST /kirim-email  - Email manual`);
    console.log(`   POST /kirim-email-artikel - Email artikel (dari Laravel)`);
    console.log(`\n⏳ Menunggu request...\n`);
});

server.on('error', (err) => {
    if (err.code === 'EADDRINUSE') {
        console.error(`❌ Port ${PORT} sudah digunakan!`);
    } else {
        console.error('❌ Server error:', err);
    }
    process.exit(1);
});

process.on('SIGINT', () => {
    console.log('\n👋 Shutting down email service...');
    server.close(() => {
        console.log('✅ Service stopped');
        process.exit(0);
    });
});