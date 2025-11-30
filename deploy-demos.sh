#!/bin/bash

# Quick Deployment Script for Template Demos
# This script helps you deploy your templates to Netlify

echo "🚀 RV Web Creations - Template Deployment Helper"
echo "================================================"
echo ""

# Check if Netlify CLI is installed
if ! command -v netlify &> /dev/null
then
    echo "❌ Netlify CLI not found."
    echo ""
    echo "📦 Install it with:"
    echo "   npm install -g netlify-cli"
    echo ""
    echo "Or use drag-and-drop deployment at: https://app.netlify.com"
    exit 1
fi

echo "✅ Netlify CLI found"
echo ""

# Show menu
echo "Which template do you want to deploy?"
echo ""
echo "1) Starter Template ($2.5k-6k)"
echo "2) Growth Template ($7.5k-18k)"
echo "3) Both Templates"
echo "4) Exit"
echo ""
read -p "Enter your choice (1-4): " choice

case $choice in
  1)
    echo ""
    echo "📦 Deploying Starter Template..."
    cd templates/starter
    netlify deploy --prod
    echo "✅ Starter template deployed!"
    ;;
  2)
    echo ""
    echo "📦 Deploying Growth Template..."
    cd templates/growth
    netlify deploy --prod
    echo "✅ Growth template deployed!"
    ;;
  3)
    echo ""
    echo "📦 Deploying Starter Template..."
    cd templates/starter
    netlify deploy --prod
    echo "✅ Starter template deployed!"
    echo ""
    echo "📦 Deploying Growth Template..."
    cd ../growth
    netlify deploy --prod
    echo "✅ Growth template deployed!"
    ;;
  4)
    echo "👋 Goodbye!"
    exit 0
    ;;
  *)
    echo "❌ Invalid choice"
    exit 1
    ;;
esac

echo ""
echo "🎉 Deployment complete!"
echo ""
echo "📝 Next steps:"
echo "1. Copy your demo URLs from above"
echo "2. Test each demo site"
echo "3. Add demo links to your portfolio page"
echo "4. Share with prospects!"
echo ""
echo "💡 Tip: Set up custom domains like:"
echo "   - starter-demo.rvwebcreations.com"
echo "   - growth-demo.rvwebcreations.com"
